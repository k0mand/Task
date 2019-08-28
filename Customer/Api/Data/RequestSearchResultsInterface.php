<?php
/**
 * Task request search results interface
 *
 * @category  Task
 * @package   Task\Customer
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Task\Customer\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface RequestSearchResultsInterface
 *
 * @package Task\Customer\Api\Data
 */
interface RequestSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param array $items
     *
     * @return SearchResultsInterface
     */
    public function setItems(array $items);
}
