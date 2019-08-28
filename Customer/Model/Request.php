<?php
/**
 * Task request model
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Task\Customer\Api\Data\RequestInterface;

/**
 * Class Request
 * @package Task\Customer\Model
 */
class Request extends AbstractModel implements RequestInterface, IdentityInterface
{
    /**#@+
     * Request's Statuses
     */
    const STATUS_NEW = 1;
    const STATUS_CHECKED = 2;
    const STATUS_CLOSED = 3;
    /**#@-*/

    const CACHE_TAG = 'task_customer_request_contact';

    /**
     * @var string
     */
    public $cacheTag = 'task_customer_request_contact';

    /**
     * @var string
     */
    public $eventPrefix = 'task_customer_request_contact';

    /**
     * Initialize Resource Module
     */
    public function _construct()
    {
        $this->_init('Task\Customer\Model\ResourceModel\Request');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get created date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get Answer data
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Get Telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return RequestInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RequestInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RequestInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return RequestInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set request status
     *
     * @param string $status
     *
     * @return RequestInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set creation date
     *
     * @param string $date
     *
     * @return RequestInterface
     */
    public function setCreatedDate($date)
    {
        return $this->setData(self::CREATED_AT, $date);
    }

    /**
     * Set Answer data
     *
     * @param string $answer
     *
     * @return RequestInterface
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return RequestInterface
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Get all answer statuses
     *
     * @return array
     */
    public function getAnswerStatuses()
    {
        return [
            self::STATUS_NEW => __('New'),
            self::STATUS_CHECKED => __('In progress'),
            self::STATUS_CLOSED => __('Closed')
        ];
    }
}
