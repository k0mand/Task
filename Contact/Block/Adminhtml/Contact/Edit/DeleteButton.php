<?php
/**
 * DeleteButton.php
 *
 * Delete button
 *
 * @category   Smile
 * @package    Smile\Contact
 * @author     Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Block\Adminhtml\Contact\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Smile\Contact\Block\Adminhtml\Contact\Edit
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
        if ($this->getContactId()) {
            $data = [
                'label' => __('Delete Contact'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Do you want delete this contact?'
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
        return $this->getUrl('*/*/delete', ['id' => $this->getContactId()]);
    }
}
