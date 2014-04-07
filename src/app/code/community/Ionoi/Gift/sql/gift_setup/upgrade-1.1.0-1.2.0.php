<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'gift/store' if not exists.
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('gift/store'))
    ->addColumn('rule_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ),
        'Rule Id')
    ->addColumn('store_id',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ),
        'Store Id')
    ->addIndex($installer
            ->getIdxName('gift/store', array(
                'rule_id'
            )),
        array(
            'rule_id'
        ))
    ->addIndex($installer
            ->getIdxName('gift/store', array(
                'store_id'
            )),
        array(
            'store_id'
        ))
    ->addForeignKey($installer
            ->getFkName('gift/store', 'rule_id', 'gift/rule', 'rule_id'),
        'rule_id',
        $installer->getTable('gift/rule'),
        'rule_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer
            ->getFkName('gift/store',
                'store_id',
                'core/store',
                'store_id'),
        'store_id',
        $installer->getTable('core/store'),
        'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Gift Rules To Store Relations');

$installer->getConnection()->createTable($table);
