<?php
namespace Task\Customer\Model\ResourceModel\Request\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Task\Customer\Model\ResourceModel\Request;
use Task\Customer\Model\ResourceModel\Request\Collection as RequestCollection;

/**
 * Class Collection
 * @package Task\Customer\Model\ResourceModel\Request\Grid
 */
class Collection extends RequestCollection implements SearchResultInterface
{
    /**
     * @var AggregationInterface
     */
    private $aggregations;
    /**
     * Initialize Model, ResourceModel
     */
    public function _construct()
    {
        $this->_init(Document::class, Request::class);
    }
    /**
     * Get aggregations
     *
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }
    /**
     * Set aggregation
     *
     * @param AggregationInterface $aggregations
     *
     * @return SearchResultInterface|void
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }
    /**
     * Get sear criteria
     *
     * @return \Magento\Framework\Api\Search\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }
    /**
     * Set search criteria
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return $this|SearchResultInterface
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }
    /**
     * Get size of elements
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }
    /**
     * Set total count
     *
     * @param int $totalCount
     *
     * @return $this|SearchResultInterface
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
    /**
     * SetItems
     *
     * @param array|null $items
     *
     * @return $this|SearchResultInterface
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
