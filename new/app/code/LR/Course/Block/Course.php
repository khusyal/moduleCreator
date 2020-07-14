<?php

namespace LR\Course\Block;

/**
 * Course content block
 */
class Course extends \Magento\Framework\View\Element\Template
{
    /**
     * Course collection
     *
     * @var LR\Course\Model\ResourceModel\Course\Collection
     */
    protected $_courseCollection = null;
    
    /**
     * Course factory
     *
     * @var \LR\Course\Model\CourseFactory
     */
    protected $_courseCollectionFactory;
    
    /** @var \LR\Course\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \LR\Course\Model\ResourceModel\Course\CollectionFactory $courseCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \LR\Course\Model\ResourceModel\Course\CollectionFactory $courseCollectionFactory,
        \LR\Course\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_courseCollectionFactory = $courseCollectionFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve course collection
     *
     * @return LR\Course\Model\ResourceModel\Course\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_courseCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared course collection
     *
     * @return LR\Course\Model\ResourceModel\Course\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_courseCollection)) {
            $this->_courseCollection = $this->_getCollection();
            $this->_courseCollection->setCurPage($this->getCurrentPage());
            $this->_courseCollection->setPageSize($this->_dataHelper->getCoursePerPage());
            $this->_courseCollection->setOrder('published_at','asc');
        }

        return $this->_courseCollection;
    }
    
    /**
     * Fetch the current page for the course list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param LR\Course\Model\Course $courseItem
     * @return string
     */
    public function getItemUrl($courseItem)
    {
        return $this->getUrl('*/*/view', array('id' => $courseItem->getId()));
    }
    
    /**
     * Return URL for resized Course Item image
     *
     * @param LR\Course\Model\Course $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('course_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $coursePerPage = $this->_dataHelper->getCoursePerPage();

            $pager->setAvailableLimit([$coursePerPage => $coursePerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}
