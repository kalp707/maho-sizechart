<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: GPL-3.0-or-later
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Model_Source_Status
{
    public function toOptionArray(): array
    {
        return [
            [
                'value' => Maho_SizeChart_Model_Chart::STATUS_ENABLED,
                'label' => Mage::helper('sizechart')->__('Enabled'),
            ],
            [
                'value' => Maho_SizeChart_Model_Chart::STATUS_DISABLED,
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
