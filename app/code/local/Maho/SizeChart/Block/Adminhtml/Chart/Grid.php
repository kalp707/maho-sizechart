<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Block_Adminhtml_Chart_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sizechartChartGrid');
        $this->setDefaultSort('chart_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    #[\Override]
    public function getGridUrl(): string
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }

    #[\Override]
    public function getRowUrl($row): string
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

    #[\Override]
    protected function _prepareCollection(): self
    {
        $collection = Mage::getModel('sizechart/chart')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    #[\Override]
    protected function _prepareColumns(): self
    {
        $this->addColumn('chart_id', [
            'header' => Mage::helper('sizechart')->__('ID'),
            'align'  => 'right',
            'width'  => '50px',
            'index'  => 'chart_id',
        ]);

        $this->addColumn('name', [
            'header' => Mage::helper('sizechart')->__('Name'),
            'align'  => 'left',
            'index'  => 'name',
        ]);

        $this->addColumn('identifier', [
            'header' => Mage::helper('sizechart')->__('Identifier'),
            'align'  => 'left',
            'width'  => '160px',
            'index'  => 'identifier',
        ]);

        $this->addColumn('status', [
            'header'  => Mage::helper('sizechart')->__('Status'),
            'align'   => 'left',
            'width'   => '80px',
            'index'   => 'status',
            'type'    => 'options',
            'options' => [
                Maho_SizeChart_Model_Chart::STATUS_ENABLED  => Mage::helper('sizechart')->__('Enabled'),
                Maho_SizeChart_Model_Chart::STATUS_DISABLED => Mage::helper('sizechart')->__('Disabled'),
            ],
        ]);

        $this->addColumn('updated_at', [
            'header' => Mage::helper('sizechart')->__('Updated'),
            'align'  => 'left',
            'width'  => '140px',
            'type'   => 'datetime',
            'index'  => 'updated_at',
        ]);

        $this->addColumn('action', [
            'header'    => Mage::helper('sizechart')->__('Action'),
            'width'     => '80',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => [
                [
                    'caption' => Mage::helper('sizechart')->__('Edit'),
                    'url'     => ['base' => '*/*/edit'],
                    'field'   => 'id',
                ],
            ],
            'filter'    => false,
            'sortable'  => false,
            'is_system' => true,
        ]);

        return parent::_prepareColumns();
    }

    #[\Override]
    protected function _prepareMassaction(): self
    {
        $this->setMassactionIdField('chart_id');
        $this->getMassactionBlock()->setFormFieldName('chart_ids');

        $this->getMassactionBlock()->addItem('delete', [
            'label'   => Mage::helper('sizechart')->__('Delete'),
            'url'     => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('sizechart')->__('Are you sure?'),
        ]);

        $statuses = Mage::getSingleton('sizechart/source_status')->toOptionArray();
        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem('status', [
            'label'      => Mage::helper('sizechart')->__('Change status'),
            'url'        => $this->getUrl('*/*/massStatus', ['_current' => true]),
            'additional' => [
                'visibility' => [
                    'name'   => 'status',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('sizechart')->__('Status'),
                    'values' => $statuses,
                ],
            ],
        ]);

        return $this;
    }
}
