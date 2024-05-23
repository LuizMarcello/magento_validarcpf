<?php

namespace AbraaoMarques\TaxvatValidator\Controller\Validate;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Taxvat implements HttpPostActionInterface
{
    private $jsonFactory;

    public function __construct(JsonFactory $jsonFactory)
    {
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        die("Entrei na minha rota");
    }
}
