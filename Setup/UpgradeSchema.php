<?php

namespace Thanhtrung1999\DailyDeal\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$setup->tableExists('tigren_dailydeal_model')) {
                $table = $setup->getConnection()->newTable(
                    $setup->getTable('tigren_dailydeal_model')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'product_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'nullable' => false,
                            'unsigned' => true,
                        ],
                        "product_id"
                    )
                    ->addColumn(
                        'deal_status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [],
                        "Deal Status"
                    )
                    ->addColumn(
                        'deal_price',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [],
                        'Deal Price'
                    )
                    ->addColumn(
                        'deal_quantity',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [],
                        'Deal Price'
                    )
                    ->addColumn(
                        'deal_time_start',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                        null,
                        [],
                        'Deal time start'
                    )
                    ->addColumn(
                        'deal_time_end',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                        null,
                        [],
                        'Deal time start'
                    )
                    ->addColumn(
                        'created_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Daily Deal Table');
                $setup->getConnection()->createTable($table);

                $setup->getConnection()->addIndex(
                    $setup->getTable('tigren_dailydeal_model'),
                    $setup->getIdxName(
                        $setup->getTable('tigren_dailydeal_model'),
                        ['product_id', 'deal_status', 'deal_price', 'deal_quantity', 'deal_time_start', 'deal_time_end']
                    ),
                    ['product_id', 'deal_status', 'deal_price', 'deal_quantity', 'deal_time_start', 'deal_time_end']
                );
            }
        }
        $setup->endSetup();
    }
}
