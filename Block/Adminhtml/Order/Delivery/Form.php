<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\CustomCheckout\Block\Adminhtml\Order\Delivery;

use Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * Adminhtml sales order address block
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Form extends \Magento\Sales\Block\Adminhtml\Order\Create\Form\AbstractForm
{
    /**
     * Delivery form template
     *
     * @var string
     */
    protected $_template = 'AHT_CustomCheckout::delivery_form.phtml';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * Order instance
     *
     * @param \Magento\Sales\Model\Order
     */
    private $_order;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Model\Session\Quote $sessionQuote
     * @param \Magento\Sales\Model\AdminOrder\Create $orderCreate
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Model\Session\Quote $sessionQuote,
        \Magento\Sales\Model\AdminOrder\Create $orderCreate,
        PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Model\Order $order,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_order = $order;
        parent::__construct(
            $context,
            $sessionQuote,
            $orderCreate,
            $priceCurrency,
            $formFactory,
            $dataObjectProcessor,
            $data
        );
    }

    /**
     * Define form attributes (id, method, action)
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $fieldset = $this->_form->addFieldset(
            'main', // html id of fieldset
            ['no_container' => true] // not use fieldset to wrap fields
        );

        $fieldset->addField(
            'id',
            'hidden',
            [
                'name' => 'id',
                'label' => __(''),
                'value' => $this->getOrder()->getId(),
            ]
        );
        $fieldset->addField(
            'delivery_date',
            'date',
            [
                'name' => 'date',
                'label' => __('Delivery date'),
                'value' => $this->getOrder()->getDeliveryDate(),
                'date_format' => 'yyyy-MM-dd',
            ]
        );
        $fieldset->addField(
            'delivery_comment',
            'textarea',
            [
                'name' => 'comment',
                'label' => __('Delivery comment'),
                'value' => $this->getOrder()->getDeliveryComment(),
                'rows' => 10,
            ]
        );

        // use <form> tag to wrap fieldset, fields
        $this->_form->setUseContainer(true);
        // form html id
        $this->_form->setId('edit_form');
        // form method
        $this->_form->setMethod('post');
        // form action
        $this->_form->setAction(
            $this->getUrl('*/*/deliverysave', ['id' => $this->getOrderId()])
        );

        return $this;
    }

    /**
     * Form header text getter
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Order Delivery Information');
    }

    /**
     * Return Form Elements values
     *
     * @return array
     */
    public function getOrderId()
    {
        return $this->getRequest()->getParam('id');
    }

    /**
     * Return current order object
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        $id = $this->getOrderId();
        $order = $this->_order->load($id);
        return $order;
    }
}
