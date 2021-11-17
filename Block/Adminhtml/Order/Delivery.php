<?php

namespace AHT\CustomCheckout\Block\Adminhtml\Order;

class Delivery extends \Magento\Framework\View\Element\Template
{
    const ADMIN_RESOURCE = 'Magento_Sales::actions_edit';

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    protected $_checkoutSession;

    /**
     * @param \Magento\Sales\Model\Order
     */
    private $_order;

    public function __construct(
        /* \Magento\Checkout\Model\Session $checkoutSession, */
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\Order $order,
        array $data = []
    ) {
        $this->_order = $order;
        /* $this->_checkoutSession = $checkoutSession; */
        parent::__construct($context, $data);
    }

    /**
     * Get current order detail
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        $id = $this->getOrderId();
        $order = $this->_order->load($id);
        return $order;
    }

    /**
     * Get current order id
     *
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getRequest()->getParam('order_id');
    }

    /**
     * Get Edit link
     *
     * @return string
     */
    public function getEditLink($label = '')
    {
        if (empty($label)) {
            $label = __('Edit');
        }
        $url = $this->getUrl('sales/order/delivery', ['id' => $this->getOrderId()]);
        return '<a href="' . $this->escapeUrl($url) . '">' . $this->escapeHtml($label) . '</a>';
    }
}
