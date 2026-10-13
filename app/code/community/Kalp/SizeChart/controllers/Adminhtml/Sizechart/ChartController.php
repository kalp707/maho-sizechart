<?php

/**
 * SPDX-FileCopyrightText: 2026 Kalp SizeChart Contributors
 * SPDX-License-Identifier: OSL-3.0
 * @package Kalp_SizeChart
 */

declare(strict_types=1);

class Kalp_SizeChart_Adminhtml_Sizechart_ChartController extends Mage_Adminhtml_Controller_Action
{
    public const ADMIN_RESOURCE = 'catalog/sizechart';

    protected function _initAction(): self
    {
        $this->loadLayout()
            ->_setActiveMenu('catalog/sizechart')
            ->_addBreadcrumb(
                Mage::helper('sizechart')->__('Catalog'),
                Mage::helper('sizechart')->__('Catalog'),
            )
            ->_addBreadcrumb(
                Mage::helper('sizechart')->__('Size Charts'),
                Mage::helper('sizechart')->__('Size Charts'),
            );
        return $this;
    }

    #[Maho\Config\Route('/admin/sizechart_chart/index')]
    public function indexAction(): void
    {
        $this->_title($this->__('Catalog'))
            ->_title($this->__('Size Charts'));

        $this->_initAction()
            ->renderLayout();
    }

    #[Maho\Config\Route('/admin/sizechart_chart/grid')]
    public function gridAction(): void
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    #[Maho\Config\Route('/admin/sizechart_chart/new')]
    public function newAction(): void
    {
        $this->_forward('edit');
    }

    #[Maho\Config\Route('/admin/sizechart_chart/edit')]
    public function editAction(): void
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Kalp_SizeChart_Model_Chart $model */
        $model = Mage::getModel('sizechart/chart');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('sizechart')->__('This size chart no longer exists.'),
                );
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($this->__('Catalog'))
            ->_title($this->__('Size Charts'));

        if ($model->getId()) {
            $this->_title($model->getName());
        } else {
            $this->_title($this->__('New Size Chart'));
        }

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('sizechart_chart', $model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('sizechart')->__('Edit Size Chart')
                    : Mage::helper('sizechart')->__('New Size Chart'),
                $id ? Mage::helper('sizechart')->__('Edit Size Chart')
                    : Mage::helper('sizechart')->__('New Size Chart'),
            )
            ->renderLayout();
    }

    #[Maho\Config\Route('/admin/sizechart_chart/save')]
    public function saveAction(): void
    {
        if ($data = $this->getRequest()->getPost()) {
            /** @var Kalp_SizeChart_Model_Chart $model */
            $model = Mage::getModel('sizechart/chart');
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('sizechart')->__('This size chart no longer exists.'),
                    );
                    $this->_redirect('*/*/');
                    return;
                }
            }

            $model->addData([
                'name' => (string) ($data['name'] ?? ''),
                'identifier' => trim((string) ($data['identifier'] ?? '')) ?: null,
                'status' => (int) ($data['status'] ?? Kalp_SizeChart_Model_Chart::STATUS_ENABLED),
                'content' => (string) ($data['content'] ?? ''),
            ]);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('sizechart')->__('The size chart has been saved.'),
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $model->getId()]);
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    #[Maho\Config\Route('/admin/sizechart_chart/delete')]
    public function deleteAction(): void
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                /** @var Kalp_SizeChart_Model_Chart $model */
                $model = Mage::getModel('sizechart/chart')->load($id);
                if (!$model->getId()) {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('sizechart')->__('This size chart no longer exists.'),
                    );
                    $this->_redirect('*/*/');
                    return;
                }

                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('sizechart')->__('The size chart has been deleted.'),
                );
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $id]);
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    #[Maho\Config\Route('/admin/sizechart_chart/massDelete')]
    public function massDeleteAction(): void
    {
        $chartIds = $this->getRequest()->getParam('chart_ids');
        if (!is_array($chartIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('sizechart')->__('Please select size chart(s).'),
            );
        } else {
            try {
                $deleted = 0;
                foreach ($chartIds as $chartId) {
                    $chart = Mage::getModel('sizechart/chart')->load($chartId);
                    if (!$chart->getId()) {
                        continue;
                    }
                    $chart->delete();
                    $deleted++;
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('sizechart')->__('Total of %d size chart(s) were deleted.', $deleted),
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    #[Maho\Config\Route('/admin/sizechart_chart/massStatus')]
    public function massStatusAction(): void
    {
        $chartIds = $this->getRequest()->getParam('chart_ids');
        if (!is_array($chartIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('sizechart')->__('Please select size chart(s).'),
            );
        } else {
            try {
                $status = (int) $this->getRequest()->getParam('status');
                $allowedStatuses = [
                    Kalp_SizeChart_Model_Chart::STATUS_ENABLED,
                    Kalp_SizeChart_Model_Chart::STATUS_DISABLED,
                ];
                if (!in_array($status, $allowedStatuses, true)) {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('sizechart')->__('Invalid status value.'),
                    );
                    $this->_redirect('*/*/index');
                    return;
                }

                $updated = 0;
                foreach ($chartIds as $chartId) {
                    $chart = Mage::getModel('sizechart/chart')->load($chartId);
                    if (!$chart->getId()) {
                        continue;
                    }
                    $chart->setStatus($status)->save();
                    $updated++;
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('sizechart')->__('Total of %d size chart(s) were updated.', $updated),
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    #[\Override]
    protected function _isAllowed(): bool
    {
        return Mage::getSingleton('admin/session')->isAllowed(self::ADMIN_RESOURCE);
    }
}
