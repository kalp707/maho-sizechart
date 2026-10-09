<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 *
 * @method int getChartId()
 * @method string getName()
 * @method string|null getIdentifier()
 * @method int getStatus()
 * @method string|null getContent()
 * @method Maho_SizeChart_Model_Chart setName(string $value)
 * @method Maho_SizeChart_Model_Chart setIdentifier(?string $value)
 * @method Maho_SizeChart_Model_Chart setStatus(int $value)
 * @method Maho_SizeChart_Model_Chart setContent(?string $value)
 */

declare(strict_types=1);

class Maho_SizeChart_Model_Chart extends Mage_Core_Model_Abstract
{
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    #[\Override]
    protected function _construct(): void
    {
        $this->_init('sizechart/chart');
    }

    #[\Override]
    protected function _beforeSave()
    {
        parent::_beforeSave();

        if (!$this->getIdentifier() && $this->getName()) {
            $this->setIdentifier($this->_slugify((string) $this->getName()));
        }

        $now = Mage::app()->getLocale()->formatDateForDb('now');
        if ($this->isObjectNew() && !$this->getCreatedAt()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);

        return $this;
    }

    private function _slugify(string $value): string
    {
        $value = strtolower(trim($value));
        $value = (string) preg_replace('/[^a-z0-9]+/', '-', $value);
        $value = trim($value, '-');

        return $value !== '' ? $value : 'chart-' . time();
    }
}
