<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Block_Adminhtml_Chart extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_chart';
        $this->_blockGroup = 'sizechart';
        $this->_headerText = Mage::helper('sizechart')->__('Size Charts');
        $this->_addButtonLabel = Mage::helper('sizechart')->__('Add Size Chart');
        parent::__construct();
    }
}
