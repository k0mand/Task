<?php
namespace Smile\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Contact
 * @package Smile\Contact\Model\ResourceModel
 */
class Contact extends AbstractDb
{
    /**
     * Initialize table
     */
    public function _construct()
    {
        $this->_init('smile_contact_us', 'id');
    }
}
