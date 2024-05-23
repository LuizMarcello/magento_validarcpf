<?php

namespace AbraaoMarques\Correios\Service;

use AbraaoMarques\Correios\Api\SearchQuotationServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use AbraaoMarques\Correios\Service\TokenService;
use AbraaoMarques\Correios\Helper\Data;

class SearchQuotationService implements SearchQuotationServiceInterface
{
    /**
     * @var TokenService
     */
    private TokenService $tokenService;

    /**
     * @var Data
     */
    private Data $helper;

    /**
     * @param TokenService $tokenService
     * @param Data $helper
     */
    public function __construct(
        TokenService $tokenService,
        Data $helper
    ) {
        $this->tokenService = $tokenService;
        $this->helper = $helper;
    }

    /**
     * Call Correios API and calc deadline and price
     * @return array|null
     */
    public function search(string $zipcode): ?array
    {
        $helper = $this->helper;
        $postingMethods = $helper->getPostingMethods();
        $methods = explode(",", $postingMethods);
        $result = [];
        
        foreach ($methods as $method) {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => ['Bearer '.$this->tokenService->get()]
            ];
            $requestDeadLine = new Request('GET', $helper->createEndPointDeadLine($zipcode, $method), $headers);
            $resDeadLine = $client->sendAsync($requestDeadLine)->wait();
            $contentDeadline = json_decode($resDeadLine->getBody()->getContents(), true);

            $requestPrice = new Request('GET', $helper->createEndPointPrice($zipcode, $method), $headers);
            $resPrice = $client->sendAsync($requestPrice)->wait();
            $contentPrice = json_decode($resPrice->getBody()->getContents(), true);
            $result[] = [
                'method' => $contentDeadline['coProduto'],
                'deadline' => $contentDeadline['prazoEntrega'],
                'price' => $contentPrice['pcFinal']
            ];
        }

        return $result;
    }
}
