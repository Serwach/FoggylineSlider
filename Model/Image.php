<?php

namespace Foggyline\Slider\Model;

use Foggyline\Slider\Api\Data\ImageInterface;
use Magento\Framework\Model\AbstractModel;

class Image extends AbstractModel
    implements ImageInterface
{
    /**
     * Get Image entity 'image_id' property value
     *
     * @return int|null
     * @api
     */
    public function getId()
    {
        return $this->getData(self::PROPERTY_ID);
    }

    /**
     * Set Image entity 'image_id' property value
     *
     * @param int $id
     * @return $this
     * @api
     */
    public function setId($id)
    {
        $this->setData(self::PROPERTY_ID, $id);
        return $this;
    }

    /**
     * Get Image entity 'image_id' property value
     *
     * @return int|null
     * @api
     */
    public function getImageId()
    {
        return $this->getData(self::PROPERTY_IMAGE_ID);
    }

    /**
     * Set Image entity 'image_id' property value
     *
     * @param int $imageId
     * @return $this
     * @api
     */
    public function setImageId($imageId)
    {
        $this->setData(self::PROPERTY_IMAGE_ID, $imageId);
        return $this;
    }

    /**
     * Get Image entity 'slide_id' property value
     *
     * @return int|null
     * @api
     */
    public function getSlideId()
    {
        return $this->getData(self::PROPERTY_SLIDE_ID);
    }

    /**
     * Set Image entity 'slide_id' property value
     *
     * @param int $slideId
     * @return $this
     * @api
     */
    public function setSlideId($slideId)
    {
        $this->setData(self::PROPERTY_SLIDE_ID, $slideId);
        return $this;
    }

    /**
     * Get Image entity 'path' property value
     *
     * @return string|null
     * @api
     */
    public function getPath()
    {
        return $this->getData(self::PROPERTY_PATH);
    }

    /**
     * Set Image entity 'path' property value
     *
     * @param string $path
     * @return $this
     * @api
     */
    public function setPath($path)
    {
        $this->setData(self::PROPERTY_PATH, $path);
        return $this;
    }

    /**
     * Initialize Foggyline Image Model
     *
     * @return void
     */
    protected function _construct()
    {
        /* _init($resourceModel) */
        $this->_init('Foggyline\Slider\Model\ResourceModel\Image');
    }
}
