<?php
/**
 * GenericButton.php
 *
 * Generic button
 *
 * @category   Smile
 * @package    Smile\Contact
 * @author     Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Block\Adminhtml\Contact\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\ContactRepositoryInterface;

/**
 * Class GenericButton
 *
 * @package Smile\Contact\Block\Adminhtml\Contact\Edit
 */
class GenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Context $context,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->context = $context;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Get Contact id
     *
     * @return |null
     */
    public function getContactId()
    {
        try {
            $modelId = $this->context->getRequest()->getParam('id');
            return $this->contactRepository->getById($modelId)->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array  $params
     *
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
