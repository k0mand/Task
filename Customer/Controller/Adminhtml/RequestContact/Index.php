<?php
/**
 * Task contact request index
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Controller\Adminhtml\RequestContact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Task\Customer\Controller\Adminhtml\RequestContact
 */
class Index extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Task_Customer::customer_request_contact';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Task_Customer::customer_request_contact');
        $resultPage->addBreadcrumb(__('Request contact'), __('Request contact'));
        $resultPage->addBreadcrumb(__('Request contact'), __('Request contact'));
        $resultPage->getConfig()->getTitle()->prepend(__('Request contact'));

        return $resultPage;
    }
}
