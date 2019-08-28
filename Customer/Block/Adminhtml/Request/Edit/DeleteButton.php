<?php
/**
 * DeleteButton.php
 *
 * Delete button
 *
 * @category   Task
 * @package    Task\Customer
 * @author     Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Block\Adminhtml\Request\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Task\Customer\Block\Adminhtml\Request\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getRequestId()) {
            $data = [
                'label' => __('Delete Request'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Do you want delete this request?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 30,
            ];
        }
        return $data;
    }

    /**
     * Get URL FOR delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getRequestId()]);
    }
}
