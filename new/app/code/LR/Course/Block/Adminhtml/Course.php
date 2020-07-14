<?php
/**
 * Adminhtml course list block
 *
 */
namespace LR\Course\Block\Adminhtml;

class Course extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_course';
        $this->_blockGroup = 'LR_Course';
        $this->_headerText = __('Course');
        $this->_addButtonLabel = __('Add New Course');
        parent::_construct();
        if ($this->_isAllowedAction('LR_Course::save')) {
            $this->buttonList->update('add', 'label', __('Add New Course'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
