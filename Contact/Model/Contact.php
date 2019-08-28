<?php
/**
 * Smile contact model
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Smile\Contact\Api\Data\ContactInterface;

/**
 * Class Contact
 * @package Smile\Contact\Model
 */
class Contact extends AbstractModel implements ContactInterface, IdentityInterface
{
    /**#@+
     * Contact's Statuses
     */
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;
    /**#@-*/

    const CACHE_TAG = 'smile_contact_us';

    /**
     * @var string
     */
    public $cacheTag = 'smile_contact_us';

    /**
     * @var string
     */
    public $eventPrefix = 'smile_contact_us';

    /**
     * Initialize Resource Module
     */
    public function _construct()
    {
        $this->_init('Smile\Contact\Model\ResourceModel\Contact');
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
     * @return ContactInterface
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
     * @return ContactInterface
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
     * @return ContactInterface
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
     * @return ContactInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set contact status
     *
     * @param string $status
     *
     * @return ContactInterface
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
     * @return ContactInterface
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
     * @return ContactInterface
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
     * @return ContactInterface
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
            self::STATUS_OPEN => __('New'),
            self::STATUS_CLOSED => __('Closed')
        ];
    }
}
