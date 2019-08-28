<?php
namespace Smile\Contact\Model;

use Smile\Contact\Api\Data;
use Smile\Contact\Api\ContactRepositoryInterface;
use Smile\Contact\Model\ResourceModel\Contact as ResourceContact;
use Smile\Contact\Model\ResourceModel\Contact\CollectionFactory as ContactCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ContactRepository
 * @package Smile\Contact\Model
 */
class ContactRepository implements ContactRepositoryInterface
{
    /**
     * @var ResourceContact
     */
    private $resource;

    /**
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * @var ContactCollectionFactory
     */
    private $contactCollectionFactory;

    /**
     * @var Data\ContactSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * ContactRepository constructor.
     * @param ResourceContact $resource
     * @param ContactFactory $contactFactory
     * @param ContactCollectionFactory $contactCollectionFactory
     * @param Data\ContactSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceContact $resource,
        ContactFactory $contactFactory,
        ContactCollectionFactory $contactCollectionFactory,
        Data\ContactSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resource = $resource;
        $this->contactFactory = $contactFactory;
        $this->contactCollectionFactory = $contactCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Get contact by contactId
     *
     * @param int $contactId
     *
     * @return ContactRepositoryInterface|Contact
     *
     * @throws NoSuchEntityException
     */
    public function getById($contactId)
    {
        $contact = $this->contactFactory->create();
        $this->resource->load($contact, $contactId);

        if (!$contact->getId()) {
            throw new NoSuchEntityException(__('Contact with id "%1" does not exist.', $contact));
        }
        return $contact;
    }

    /**
     * Get contacts by criteria
     *
     * @param SearchCriteriaInterface|null $criteria
     *
     * @return Data\ContactSearchResultsInterface|ContactRepositoryInterface
     */
    public function getList(SearchCriteriaInterface $criteria = null)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->contactCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $contact = [];
        /** @var Data\ContactInterface $contactModel */
        foreach ($collection as $contactModel) {
            $contact[] = $contactModel;
        }
        $searchResults->setItems($contact);
        return $searchResults;
    }

    /**
     * Delete Contact
     *
     * @param Data\ContactInterface $contact
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     */
    public function delete(Data\ContactInterface $contact)
    {
        try {
            $this->resource->delete($contact);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Save contact
     *
     * @param Data\ContactInterface $contact
     *
     * @return Data\ContactInterface|ContactRepositoryInterface
     *
     * @throws CouldNotSaveException
     */
    public function save(Data\ContactInterface $contact)
    {
        try {
            $this->resource->save($contact);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $contact;
    }

    /**
     * Delete contact by id
     *
     * @param int $contactId
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($contactId)
    {
        return $this->delete($this->getById($contactId));
    }
}
