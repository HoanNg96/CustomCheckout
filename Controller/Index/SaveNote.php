<?php

namespace AHT\CustomCheckout\Controller\Index;

class SaveNote extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */
    private $_quoteRepository;

    /**
     * @param \Magento\Framework\Serialize\Serializer\Json
     */
    private $_json;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Framework\Serialize\Serializer\Json $json
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_quoteRepository = $quoteRepository;
        $this->_json = $json;
        return parent::__construct($context);
    }

    /**
     * Save custom checkout form data to current quote
     *
     * @return void
     */
    public function execute()
    {
        // get data from knockoutjs
        $data = $this->getRequest()->getContent();
        // convert json data to array
        $response = $this->_json->unserialize($data);
        $quoteId = $response['quoteId'];
        // get current quote Id
        $quote = $this->_quoteRepository->get($quoteId);
        // add data to current quote
        /* $quote->setData('customer_note', $response['note']); */
        $quote->setCustomerNote($response['note']);
        // save quote
        $this->_quoteRepository->save($quote);
    }
}
