<?php
/**
 * Smile contact search results interface
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ContactSearchResultsInterface
 *
 * @package Smile\Contact\Api\Data
 */
interface ContactSearchResultsInterface extends SearchResultsInterface
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
