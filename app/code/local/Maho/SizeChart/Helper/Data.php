<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: GPL-3.0-or-later
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_moduleName = 'Maho_SizeChart';

    public const XML_PATH_ENABLED = 'sizechart/general/enabled';
    public const XML_PATH_LINK_LABEL = 'sizechart/general/link_label';
    public const ATTR_CODE = 'size_chart';

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->isModuleEnabled()
            && $this->isModuleOutputEnabled()
            && Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $storeId);
    }

    public function getLinkLabel(?int $storeId = null): string
    {
        $label = trim((string) Mage::getStoreConfig(self::XML_PATH_LINK_LABEL, $storeId));
        return $label !== '' ? $label : (string) $this->__('Size Guide');
    }

    public function getChartForProduct(Mage_Catalog_Model_Product $product): ?Maho_SizeChart_Model_Chart
    {
        if (!$this->isEnabled((int) $product->getStoreId())) {
            return null;
        }

        $chartId = (int) $product->getData(self::ATTR_CODE);
        if ($chartId <= 0) {
            return null;
        }

        /** @var Maho_SizeChart_Model_Chart $chart */
        $chart = Mage::getModel('sizechart/chart')->load($chartId);
        if (!$chart->getId() || (int) $chart->getStatus() !== Maho_SizeChart_Model_Chart::STATUS_ENABLED) {
            return null;
        }

        return $chart;
    }
}
