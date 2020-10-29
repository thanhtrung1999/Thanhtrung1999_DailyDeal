<?php
namespace Thanhtrung1999\DailyDeal\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Deal extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_deal';
        $this->_blockGroup = 'Thanhtrung1999_DailyDeal';
        $this->_headerText = __('Deals');
        $this->_addButtonLabel = __('Add New Deal');
        parent::_construct();
    }
}
