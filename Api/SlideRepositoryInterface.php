<?php

namespace Foggyline\Slider\Api;

use Foggyline\Slider\Api\Data\SlideInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 */
interface SlideRepositoryInterface
{
    /**
     * Retrieve slide entity.
     * @param int $slideId
     * @return SlideInterface
     * @throws NoSuchEntityException If slide with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function getById($slideId);

    /**
     * Save slide.
     * @param SlideInterface $slide
     * @return SlideInterface
     * @throws LocalizedException
     */
    public function save(SlideInterface $slide);

    /**
     * Retrieve slides matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete slide by ID.
     * @param int $slideId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($slideId);
}
