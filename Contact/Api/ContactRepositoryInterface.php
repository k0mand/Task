<?php
/**
 * Smile contact repository interface
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Smile\Contact\Api\Data\ContactInterface;

/**
 * Interface ContactRepositoryInterface
 * @package Smile\Contact\Api
 */
interface ContactRepositoryInterface
{
    /**
     * Get Contacts by id
     *
     * @param $objectId
     *
     * @return ContactRepositoryInterface
     */
    public function getById($objectId);

    /**
     * Get Contacts by criteria
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return ContactRepositoryInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Save contact
     *
     * @param ContactInterface $object
     *
     * @return ContactRepositoryInterface
     */
    public function save(ContactInterface $object);

    /**
     * Delete Contact
     *
     * @param Data\ContactInterface $contact
     *
     * @return bool
     */
    public function delete(Data\ContactInterface $contact);

    /**
     * Delete contact
     *
     * @param $objectId
     *
     * @return bool
     */
    public function deleteById($objectId);
}
