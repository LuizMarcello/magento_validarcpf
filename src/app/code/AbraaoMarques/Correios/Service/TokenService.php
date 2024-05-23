<?php

namespace AbraaoMarques\Correios\Service;

use AbraaoMarques\Correios\Api\SearchQuotationServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use AbraaoMarques\Correios\Helper\Data;

class TokenService
{
    private $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Get Token from Correios API
     *
     * @return string|null
     */
    public function get(): ?string
    {
        $helper = $this->helper;
        $user = $helper->getLogin();
        $pass = $helper->getPassword();
        // $encoded = base64_decode($user, $pass);
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => ['Basic '.base64_encode($user.':'.$pass)]
        ];
        $body = [
            "numero" => $helper->getCodePost()
        ];
        $request = new Request('POST', $helper->createTokenEndPoint(), $headers, json_encode($body));
        $res = $client->sendAsync($request)->wait();
        $content = json_decode($res->getBody()->getContents(), true);
        return $content['token'];
    }
}
