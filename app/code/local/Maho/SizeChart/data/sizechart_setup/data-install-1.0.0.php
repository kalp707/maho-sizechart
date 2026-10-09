<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 *
 * @var Mage_Catalog_Model_Resource_Setup $this
 */

declare(strict_types=1);

$installer = $this;
$installer->startSetup();

$attributeCode = 'size_chart';

if (!$installer->getAttributeId('catalog_product', $attributeCode)) {
    $installer->addAttribute('catalog_product', $attributeCode, [
        'type'                    => 'int',
        'label'                   => 'Size Chart',
        'input'                   => 'select',
        'source'                  => 'sizechart/source_chart',
        'required'                => false,
        'sort_order'              => 90,
        'global'                  => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'searchable'              => false,
        'filterable'              => false,
        'comparable'              => false,
        'visible_on_front'        => false,
        'used_in_product_listing' => false,
        'unique'                  => false,
        'apply_to'                => '',
        'group'                   => 'General',
        'note'                    => 'Select a size chart to show on the product page.',
    ]);
}

$installer->endSetup();
