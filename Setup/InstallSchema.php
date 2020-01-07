<?php

namespace Magenest\Staff\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();

        $tableStaff = $setup->getTable('magenest_staff');

        if ($conn->isTableExists($tableStaff) != true) {

            $table = $conn->newTable($tableStaff)
                ->addColumn('id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null, [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )->addColumn(
                    'customer_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null, ['nullable' => false],
                    'Customer ID'
                )->addColumn(
                    'nick_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Nick Name'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Updated at'
                )->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null, [
                    'nullable' => false,
                ],
                    'Status'
                )->addColumn(
                    'type',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null, ['nullable' => false],
                    'Type'
                )->setOption('charset', 'utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}