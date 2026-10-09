<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Model_Resource_Chart extends Mage_Core_Model_Resource_Db_Abstract
{
    #[\Override]
    protected function _construct(): void
    {
        $this->_init('sizechart/chart', 'chart_id');
    }
}
