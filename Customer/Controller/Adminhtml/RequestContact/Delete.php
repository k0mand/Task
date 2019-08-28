<?php
/**
 * Task contact request delete
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Controller\Adminhtml\RequestContact;

use Magento\Backend\App\Action;
use Task\Customer\Api\RequestRepositoryInterface;

/**
 * Class Delete
 *
 * @package Task\Customer\Controller\Adminhtml\RequestContact
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Task_Customer::customer_request_contact_delete';

    /**
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * Delete constructor.
     *
     * @param Action\Context $context
     * @param RequestRepositoryInterface $requestRepository
     */
    public function __construct(
        Action\Context              $context,
        RequestRepositoryInterface $requestRepository
    ) {
        $this->requestRepository = $requestRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $requestId = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($requestId) {
            try {
                $requestRepository = $this->requestRepository;
                $requestRepository->deleteById($requestId);
                $this->messageManager->addSuccessMessage(__('The request has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['id' => $requestId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a request to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
