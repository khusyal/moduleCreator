<?php

namespace LR\Course\Model\ResourceModel;

/**
 * Course Resource Model
 */
class Course extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('lr_course', 'course_id');
    }
}
