<?php
namespace AHT\CustomCheckout\Observer;

class SaveOrderBeforeSalesModelQuoteObserver implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\DataObject\Copy
     */
    private $objectCopyService;

    public function __construct(
        \Magento\Framework\DataObject\Copy $objectCopyService
    )
    {
        $this->objectCopyService = $objectCopyService;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        $this->objectCopyService->copyFieldsetToTarget('quote', 'sales_order', $quote, $order);

        return $this;
    }
}