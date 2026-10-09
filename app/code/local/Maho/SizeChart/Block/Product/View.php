<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Block_Product_View extends Mage_Catalog_Block_Product_Abstract
{
    private ?Maho_SizeChart_Model_Chart $chart = null;
    private bool $chartLoaded = false;

    public function canShow(): bool
    {
        return $this->getChart() !== null;
    }

    public function getChart(): ?Maho_SizeChart_Model_Chart
    {
        if ($this->chartLoaded) {
            return $this->chart;
        }

        $this->chartLoaded = true;
        $product = $this->getProduct();
        if (!$product || !$product->getId()) {
            return null;
        }

        $this->chart = Mage::helper('sizechart')->getChartForProduct($product);
        return $this->chart;
    }

    public function getLinkLabel(): string
    {
        return Mage::helper('sizechart')->getLinkLabel((int) Mage::app()->getStore()->getId());
    }

    public function getModalTitle(): string
    {
        $chart = $this->getChart();
        return $chart ? (string) $chart->getName() : $this->getLinkLabel();
    }

    public function getChartHtml(): string
    {
        $chart = $this->getChart();
        return $chart ? (string) $chart->getContent() : '';
    }

    #[\Override]
    protected function _toHtml(): string
    {
        if (!$this->canShow()) {
            return '';
        }
        return parent::_toHtml();
    }
}
