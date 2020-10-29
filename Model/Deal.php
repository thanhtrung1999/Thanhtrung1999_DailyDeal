<?php
namespace Thanhtrung1999\DailyDeal\Model;

class Deal extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'tigren_dailydeal_model';

    protected $_cacheTag = 'tigren_dailydeal_model';

    protected $_eventPrefix = 'tigren_dailydeal_model';

    protected function _construct()
    {
        $this->_init('Thanhtrung1999\DailyDeal\Model\ResourceModel\Deal');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
