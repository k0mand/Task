<?php
/**
 * Smile contact save
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DataObject;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Smile\Contact\Api\ContactRepositoryInterface;
use Smile\Contact\Model\ContactFactory;
use Smile\Contact\Model\Contact;
use Magento\Framework\App\Area;

/**
 * Class Save
 *
 * @package Smile\Contact\Controller\Adminhtml\ContactContact
 */
class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::contact_us_save';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        Action\Context $context,
        Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        ContactRepositoryInterface $contactRepository,
        ContactFactory $contactFactory
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->dataPersistor = $dataPersistor;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        if ($data) {    
            $postObject = new DataObject();
            $postObject->setData($data);

            $id = $this->getRequest()->getParam('id');

            try {
                if ($id) {
                    $model = $this->contactRepository->getById($id);
                }

                $model->setData($data);
                $message = __('Saving the successful.');

                if (!empty($data['answer'])) {

                    $this->inlineTranslation->suspend();

                    $transport = $this->transportBuilder
                        ->setTemplateIdentifier('admin_email_answer_template')
                        ->setTemplateOptions(
                            [
                                'area' => Area::AREA_FRONTEND,
                                'store' => Store::DEFAULT_STORE_ID,
                            ]
                        )
                        ->setTemplateVars(['data' => $postObject])
                        ->setFrom($this->getSenderData())
                        ->addTo($model->getEmail())
                        ->getTransport();

                    $transport->sendMessage();

                    $this->inlineTranslation->resume();
                    $model->setStatus(Contact::STATUS_CLOSED);
                    $message = __('Email has been sent.');
                }

                $this->contactRepository->save($model);
                $this->messageManager->addSuccessMessage($message);
                $this->dataPersistor->clear('contact_us');

                $resultRedirect->setPath('*/*/');

                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while answer the contact.'));
            }

            $this->dataPersistor->set('contact_us', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Get sender name and email
     *
     * @return array
     */
    public function getSenderData()
    {
        return [
            'name' => $this->scopeConfig->getValue(
                'trans_email/ident_support/name',
                ScopeInterface::SCOPE_STORE
            ),
            'email' => $this->scopeConfig->getValue(
                'trans_email/ident_support/email',
                ScopeInterface::SCOPE_STORE
            )
        ];
    }
}
