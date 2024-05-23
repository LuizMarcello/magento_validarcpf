<?php

namespace AbraaoMarques\Correios\Controller\Search;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use AbraaoMarques\Correios\Model\Quotation as ModelQuotation;
use Magento\Framework\Controller\Result\JsonFactory;

class Quotation implements HttpPostActionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ModelQuotation
     */
    private $modelQuotation;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @param RequestInterface $request
     * @param JsonFactory $jsonFactory
     * @param ModelQuotation $modelQuotation
     */
    public function __construct(
        RequestInterface $request,
        JsonFactory $jsonFactory,
        ModelQuotation $modelQuotation
    ) {
        $this->request = $request;
        $this->jsonFactory = $jsonFactory;
        $this->modelQuotation = $modelQuotation;
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->request->getParams();
        $zipcode = str_replace('-', "", $data['zipcode']);
        $result = $this->modelQuotation->inProductPage($zipcode);
        $json = $this->jsonFactory->create();

        return $json->setData($result);
    }
}
