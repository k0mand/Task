<?php
namespace Smile\Contact\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Smile\Contact\Model\ResourceModel\Contact
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize Model, ResourceModel
     */
    public function _construct()
    {
        $this->_init('Smile\Contact\Model\Contact', 'Smile\Contact\Model\ResourceModel\Contact');
    }
}
