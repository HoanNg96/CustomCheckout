<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\CustomCheckout\Block\Adminhtml\Order;

/**
 * Adminhtml sales order address block
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class DeliveryForm extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Data Form object
     *
     * @var \Magento\Framework\Data\Form
     */
    protected $_form;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Model\Order $order,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->_formFactory = $formFactory;
        $this->_order = $order;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_order';
        // Point to block Delivery/Form.php
        $this->_mode = 'delivery';
        $this->_blockGroup = 'AHT_CustomCheckout';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Order Delivery'));
        $this->buttonList->remove('delete');
    }

    /**
     * Get current order id
     *
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getRequest()->getParam('id');
    }

    /**
     * Back button url getter
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('sales/*/view', ['order_id' => $this->getOrderId()]);
    }
}
