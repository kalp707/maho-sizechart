<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Model_Source_Chart extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    #[\Override]
    public function getAllOptions($withEmpty = true, $defaultValues = false)
    {
        if ($this->_options === null) {
            $this->_options = [];
            /** @var Maho_SizeChart_Model_Resource_Chart_Collection $collection */
            $collection = Mage::getResourceModel('sizechart/chart_collection');
            $collection->setOrder('name', 'ASC');

            foreach ($collection as $chart) {
                $this->_options[] = [
                    'value' => (int) $chart->getId(),
                    'label' => (string) $chart->getName(),
                ];
            }
        }

        $options = $this->_options;
        if ($withEmpty) {
            array_unshift($options, [
                'value' => '',
                'label' => Mage::helper('sizechart')->__('-- Please Select --'),
            ]);
        }

        return $options;
    }

    public function getOptionArray(): array
    {
        $options = [];
        foreach ($this->getAllOptions(false) as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }
}
