<?php

/**
 * SPDX-FileCopyrightText: 2026 Kalp SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Kalp_SizeChart
 */

declare(strict_types=1);

class Kalp_SizeChart_Block_Adminhtml_Chart_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'sizechart';
        $this->_controller = 'adminhtml_chart';

        $this->_updateButton('save', 'label', Mage::helper('sizechart')->__('Save Size Chart'));
        $this->_updateButton('delete', 'label', Mage::helper('sizechart')->__('Delete Size Chart'));

        $this->_addButton('saveandcontinue', [
            'label'   => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save',
        ], -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit(document.getElementById('edit_form').action+'back/edit/');
            }
        ";
    }

    #[\Override]
    public function getHeaderText(): string
    {
        $chart = Mage::registry('sizechart_chart');
        if ($chart && $chart->getId()) {
            return Mage::helper('sizechart')->__(
                "Edit Size Chart '%s'",
                $this->escapeHtml($chart->getName()),
            );
        }
        return Mage::helper('sizechart')->__('New Size Chart');
    }
}
