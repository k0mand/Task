<?php
namespace Task\Customer\Model\ResourceModel\Request;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Task\Customer\Model\ResourceModel\Request
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize Model, ResourceModel
     */
    public function _construct()
    {
        $this->_init('Task\Customer\Model\Request', 'Task\Customer\Model\ResourceModel\Request');
    }
}
