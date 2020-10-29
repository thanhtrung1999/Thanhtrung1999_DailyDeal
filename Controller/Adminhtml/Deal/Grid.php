<?php
namespace Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

use Thanhtrung1999\DailyDeal\Controller\Adminhtml\Deal;

class Grid extends Deal
{
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}
