<?php
/**
 * Task request repository interface
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Task\Customer\Api\Data\RequestInterface;

/**
 * Interface RequestRepositoryInterface
 * @package Task\Customer\Api
 */
interface RequestRepositoryInterface
{
    /**
     * Get Requests by id
     *
     * @param $objectId
     *
     * @return RequestRepositoryInterface
     */
    public function getById($objectId);

    /**
     * Get Requests by criteria
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return RequestRepositoryInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Save request
     *
     * @param RequestInterface $object
     *
     * @return RequestRepositoryInterface
     */
    public function save(RequestInterface $object);

    /**
     * Delete Request
     *
     * @param Data\RequestInterface $request
     *
     * @return bool
     */
    public function delete(Data\RequestInterface $request);

    /**
     * Delete request
     *
     * @param $objectId
     *
     * @return bool
     */
    public function deleteById($objectId);
}
