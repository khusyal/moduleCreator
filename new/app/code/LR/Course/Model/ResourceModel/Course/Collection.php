<?php

/**
 * Course Resource Collection
 */
namespace LR\Course\Model\ResourceModel\Course;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('LR\Course\Model\Course', 'LR\Course\Model\ResourceModel\Course');
    }
}
