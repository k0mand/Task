<?php
/**
 * Smile contact delete
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Smile\Contact\Api\ContactRepositoryInterface;

/**
 * Class Delete
 *
 * @package Smile\Contact\Controller\Adminhtml\ContactContact
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Contact::contact_us_delete';

    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * Delete constructor.
     *
     * @param Action\Context $context
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Action\Context              $context,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $contactId = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($contactId) {
            try {
                $contactRepository = $this->contactRepository;
                $contactRepository->deleteById($contactId);
                $this->messageManager->addSuccessMessage(__('The contact has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['id' => $contactId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a contact to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
