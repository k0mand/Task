<?php
/**
 * GenericButton.php
 *
 * Generic button
 *
 * @category   Task
 * @package    Task\Customer
 * @author     Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Block\Adminhtml\Request\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Task\Customer\Api\RequestRepositoryInterface;

/**
 * Class GenericButton
 *
 * @package Task\Customer\Block\Adminhtml\Request\Edit
 */
class GenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param RequestRepositoryInterface $requestRepository
     */
    public function __construct(
        Context $context,
        RequestRepositoryInterface $requestRepository
    ) {
        $this->context = $context;
        $this->requestRepository = $requestRepository;
    }

    /**
     * Get Request id
     *
     * @return |null
     */
    public function getRequestId()
    {
        try {
            $modelId = $this->context->getRequest()->getParam('id');
            return $this->requestRepository->getById($modelId)->getId();
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
