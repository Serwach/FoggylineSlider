<?php

namespace Foggyline\Slider\Model;

use Foggyline\Slider\Api\Data\SlideInterface;
use Magento\Framework\Model\AbstractModel;

class Slide extends AbstractModel
    implements SlideInterface
{
    /**
     * Get Slide entity 'slide_id' property value
     *
     * @return int|null
     * @api
     */
    public function getId()
    {
        return $this->getData(self::PROPERTY_ID);
    }

    /**
     * Set Slide entity 'slide_id' property value
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
     * Get Slide entity 'slide_id' property value
     *
     * @return int|null
     * @api
     */
    public function getSlideId()
    {
        return $this->getData(self::PROPERTY_SLIDE_ID);
    }

    /**
     * Set Slide entity 'slide_id' property value
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
     * Get Slide entity 'title' property value
     *
     * @return string|null
     * @api
     */
    public function getTitle()
    {
        return $this->getData(self::PROPERTY_TITLE);
    }

    /**
     * Set Slide entity 'title' property value
     *
     * @param string $title
     * @return $this
     * @api
     */
    public function setTitle($title)
    {
        $this->setData(self::PROPERTY_TITLE, $title);
    }

    /**
     * Initialize Foggyline Slide Model
     *
     * @return void
     */
    protected function _construct()
    {
        /* _init($resourceModel) */
        $this->_init('Foggyline\Slider\Model\ResourceModel\Slide');
    }
}
