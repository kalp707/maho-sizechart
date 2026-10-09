<?php

/**
 * SPDX-FileCopyrightText: 2026 Maho SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Maho_SizeChart
 */

declare(strict_types=1);

class Maho_SizeChart_Block_Adminhtml_Chart_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    #[\Override]
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadWysiwyg(true);
        }
        return $this;
    }

    #[\Override]
    protected function _prepareForm(): self
    {
        /** @var Maho_SizeChart_Model_Chart $model */
        $model = Mage::registry('sizechart_chart');

        $form = new \Maho\Data\Form([
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
            'method' => 'post',
        ]);
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('base_fieldset', [
            'legend' => Mage::helper('sizechart')->__('Size Chart Information'),
        ]);

        if ($model->getId()) {
            $fieldset->addField('chart_id', 'hidden', [
                'name' => 'chart_id',
            ]);
        }

        $fieldset->addField('name', 'text', [
            'name'     => 'name',
            'label'    => Mage::helper('sizechart')->__('Name'),
            'title'    => Mage::helper('sizechart')->__('Name'),
            'required' => true,
        ]);

        $fieldset->addField('identifier', 'text', [
            'name'  => 'identifier',
            'label' => Mage::helper('sizechart')->__('Identifier'),
            'title' => Mage::helper('sizechart')->__('Identifier'),
            'class' => 'validate-xml-identifier',
            'note'  => Mage::helper('sizechart')->__('Leave empty to auto-generate from the name.'),
        ]);

        $fieldset->addField('status', 'select', [
            'name'     => 'status',
            'label'    => Mage::helper('sizechart')->__('Status'),
            'title'    => Mage::helper('sizechart')->__('Status'),
            'required' => true,
            'options'  => [
                Maho_SizeChart_Model_Chart::STATUS_ENABLED  => Mage::helper('sizechart')->__('Enabled'),
                Maho_SizeChart_Model_Chart::STATUS_DISABLED => Mage::helper('sizechart')->__('Disabled'),
            ],
        ]);

        if (!$model->getId()) {
            $model->setStatus(Maho_SizeChart_Model_Chart::STATUS_ENABLED);
        }

        $fieldset->addField('content', 'editor', [
            'name'     => 'content',
            'label'    => Mage::helper('sizechart')->__('Content'),
            'title'    => Mage::helper('sizechart')->__('Content'),
            'style'    => 'height:36em',
            'required' => true,
            'config'   => Mage::getSingleton('cms/wysiwyg_config')->getConfig([
                'sanitize_preview_url' => Mage::helper('cms')->getSanitizePreviewUrl(),
            ]),
        ]);

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}
