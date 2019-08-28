<?php
/**
 * Smile contact edit
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Smile\Contact\Api\ContactRepositoryInterface;

/**
 * Class Edit
 *
 * @package Smile\Contact\Controller\Adminhtml\ContactContact
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::contact_us_save';

    /**
     * Core registry
     *
     * @var Registry
     */
    private $coreRegistry;

    /**
     * Page factory
     *
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * Edit constructor.
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->contactRepository = $contactRepository;
        parent::__construct($context);
    }

    /**
     * Edit Contact page
     *
     * @return \Magento\Backend\Model\View\Result\Page | \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $model = $this->contactRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This contact does not exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->coreRegistry->register('contact_us', $model);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage->setActiveMenu('Smile_Contact::contact_us')
            ->addBreadcrumb(__('Contact'), __('Contact'))
            ->addBreadcrumb(__('Edit Contact'), __('Edit Contact'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit Contact') : __('New Contact'),
            $id ? __('Edit Contact') : __('New Contact')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Contact'));

        return $resultPage;
    }
}
