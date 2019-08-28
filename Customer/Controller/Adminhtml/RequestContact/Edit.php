<?php
/**
 * Task contact request edit
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Controller\Adminhtml\RequestContact;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Task\Customer\Api\RequestRepositoryInterface;

/**
 * Class Edit
 *
 * @package Task\Customer\Controller\Adminhtml\RequestContact
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Task_Customer::customer_request_contact_save';

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
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * Edit constructor.
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param RequestRepositoryInterface $requestRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        RequestRepositoryInterface $requestRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->requestRepository = $requestRepository;
        parent::__construct($context);
    }

    /**
     * Edit Request page
     *
     * @return \Magento\Backend\Model\View\Result\Page | \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $model = $this->requestRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This request does not exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->coreRegistry->register('customer_request_contact', $model);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage->setActiveMenu('Task_Customer::customer_request_contact')
            ->addBreadcrumb(__('Request'), __('Request'))
            ->addBreadcrumb(__('Edit Request'), __('Edit Request'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit Request') : __('New Request'),
            $id ? __('Edit Request') : __('New Request')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Request'));

        return $resultPage;
    }
}
