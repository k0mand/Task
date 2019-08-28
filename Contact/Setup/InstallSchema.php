<?php
/**
 * Smile Install Schema
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Roman Koshyk <romadaaaa@gmail.com>
 */
namespace Smile\Contact\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Smile\Contact\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()->newTable(
            $installer->getTable('smile_contact_us')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
            'Contact id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [],
            'Contact name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            [],
            'Contact email'
        )->addColumn(
            'comment',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Contact comment'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => false,
                'default' => '1'
            ],
            'Answer status'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT
            ],
            'Contact date'
        )->addColumn(
            'answer',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Answer on contact'
        )->addColumn(
            'telephone',
            Table::TYPE_TEXT,
            255,
            [
                'unsigned' => true,
                'nullable' => true
            ],
            'Contact telephone'
        )->setComment(
            'Catalog for contact us'
        );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
