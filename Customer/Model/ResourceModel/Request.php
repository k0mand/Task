<?php
namespace Task\Customer\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Request
 * @package Task\Customer\Model\ResourceModel
 */
class Request extends AbstractDb
{
    /**
     * Initialize table
     */
    public function _construct()
    {
        $this->_init('task_customer_request_contact', 'id');
    }
}
