<?php

/**
 * SPDX-FileCopyrightText: 2026 Kalp SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Kalp_SizeChart
 */

declare(strict_types=1);

class Kalp_SizeChart_Model_Source_Status
{
    public function toOptionArray(): array
    {
        return [
            [
                'value' => Kalp_SizeChart_Model_Chart::STATUS_ENABLED,
                'label' => Mage::helper('sizechart')->__('Enabled'),
            ],
            [
                'value' => Kalp_SizeChart_Model_Chart::STATUS_DISABLED,
                'label' => Mage::helper('sizechart')->__('Disabled'),
            ],
        ];
    }

    public function getOptionArray(): array
    {
        $options = [];
        foreach ($this->toOptionArray() as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }
}
