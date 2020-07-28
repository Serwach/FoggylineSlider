<?php

namespace Foggyline\Slider\Model;

use Exception;
use Foggyline\Slider\Api\Data\SlideInterface;
use Foggyline\Slider\Api\Data\SlideInterfaceFactory;
use Foggyline\Slider\Api\SlideRepositoryInterface;
use Foggyline\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

class SlideRepository implements SlideRepositoryInterface
{
    /**
     * @var \Foggyline\Slider\Model\ResourceModel\Slide
     */
    protected $resource;

    /**
     * @var SlideFactory
     */
    protected $slideFactory;

    /**
     * @var CollectionFactory
     */
    protected $slideCollectionFactory;

    /**
     * @var SearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var SlideInterfaceFactory
     */
    protected $dataSlideFactory;

    /**
     * @param ResourceModel\Slide $resource
     * @param SlideFactory $slideFactory
     * @param ResourceModel\Slide\CollectionFactory $slideCollectionFactory
     * @param SearchResultsInterface $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param SlideInterfaceFactory $dataSlideFactory
     */
    public function __construct(
        \Foggyline\Slider\Model\ResourceModel\Slide $resource,
        SlideFactory $slideFactory,
        CollectionFactory $slideCollectionFactory,
        SearchResultsInterface $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        SlideInterfaceFactory $dataSlideFactory

    ) {
        $this->resource = $resource;
        $this->slideFactory = $slideFactory;
        $this->slideCollectionFactory = $slideCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataSlideFactory = $dataSlideFactory;
    }

    /**
     * Save slide.
     *
     * @param SlideInterface $slide
     * @return SlideInterface
     * @throws LocalizedException
     */
    public function save(SlideInterface $slide)
    {
        try {
            $this->resource->save($slide);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $slide;
    }

    /**
     * Retrieve slides matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $this->searchResultsFactory->setSearchCriteria($searchCriteria);

        $collection = $this->slideCollectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $this->searchResultsFactory->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    (strtoupper($sortOrder->getDirection()) === 'ASC') ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $slides = [];
        /** @var Slide $slideModel */
        foreach ($collection as $slideModel) {
            $slideData = $this->dataSlideFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $slideData,
                $slideModel->getData(),
                '\Foggyline\Slider\Api\Data\SlideInterface'
            );
            $slides[] = $this->dataObjectProcessor->buildOutputDataArray(
                $slideData,
                '\Foggyline\Slider\Api\Data\SlideInterface'
            );
        }
        $this->searchResultsFactory->setItems($slides);
        return $this->searchResultsFactory;
    }

    /**
     * Delete slide by ID.
     *
     * @param int $slideId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($slideId)
    {
        return $this->delete($this->getById($slideId));
    }

    /**
     * Delete Slide
     *
     * @param SlideInterface $slide
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(SlideInterface $slide)
    {
        try {
            $this->resource->delete($slide);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Retrieve slide entity.
     *
     * @param int $slideId
     * @return SlideInterface
     * @throws NoSuchEntityException If slide with the specified ID does not exist.
     * @throws LocalizedException
     * @api
     */
    public function getById($slideId)
    {
        $slide = $this->slideFactory->create();
        $this->resource->load($slide, $slideId);
        if (!$slide->getId()) {
            throw new NoSuchEntityException(__('Slide with id %1 does not exist.', $slideId));
        }
        return $slide;
    }
}
