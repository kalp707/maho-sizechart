<?php

/**
 * SPDX-FileCopyrightText: 2026 Kalp SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Kalp_SizeChart
 */

declare(strict_types=1);

class Kalp_SizeChart_Model_Resource_Chart_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    #[\Override]
    protected function _construct(): void
    {
        $this->_init('sizechart/chart');
    }

    public function addActiveFilter(): self
    {
        $this->addFieldToFilter('status', Kalp_SizeChart_Model_Chart::STATUS_ENABLED);
        return $this;
    }
}
