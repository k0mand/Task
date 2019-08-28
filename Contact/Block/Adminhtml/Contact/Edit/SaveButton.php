<?php
/**
 * SaveButton.php
 *
 * Save button
 *
 * @category   Smile
 * @package    Smile\Contact
 * @author     Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Block\Adminhtml\Contact\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 *
 * @package Smile\Contact\Block\Adminhtml\Contact\Edit
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get Save button
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save contact'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 40,
        ];
    }
}
