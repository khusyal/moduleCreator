<?php

namespace LR\Course\Model;

/**
 * Course Model
 *
 * @method \LR\Course\Model\Resource\Page _getResource()
 * @method \LR\Course\Model\Resource\Page getResource()
 */
class Course extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('LR\Course\Model\ResourceModel\Course');
    }

}
