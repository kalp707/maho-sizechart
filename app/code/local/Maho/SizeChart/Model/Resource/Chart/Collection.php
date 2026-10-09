<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: GPL-3.0-or-later
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Model_Resource_Chart_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    #[\Override]
    protected function _construct(): void
    {
        $this->_init('sizechart/chart');
    }

    public function addActiveFilter(): self
    {
        $this->addFieldToFilter('status', Maho_SizeChart_Model_Chart::STATUS_ENABLED);
        return $this;
    }
}
