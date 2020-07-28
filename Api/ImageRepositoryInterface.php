<?php

namespace Foggyline\Slider\Api;

use Foggyline\Slider\Api\Data\ImageInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 */
interface ImageRepositoryInterface
{
    /**
     * Retrieve image entity.
     * @param int $imageId
     * @return ImageInterface
     * @throws NoSuchEntityException If image with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function getById($imageId);

    /**
     * Save image.
     * @param ImageInterface $image
     * @return ImageInterface
     * @throws LocalizedException
     */
    public function save(ImageInterface $image);

    /**
     * Retrieve images matching the specified criteria.
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
