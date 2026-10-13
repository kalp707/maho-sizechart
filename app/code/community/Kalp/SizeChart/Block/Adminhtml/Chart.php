<?php

/**
 * SPDX-FileCopyrightText: 2026 Kalp SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Kalp_SizeChart
 */

declare(strict_types=1);

class Kalp_SizeChart_Block_Adminhtml_Chart extends Mage_Adminhtml_Block_Widget_Grid_Container
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
