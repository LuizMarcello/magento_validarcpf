<?php

namespace AbraaoMarques\Correios\Model;

use AbraaoMarques\Correios\Helper\Data;
use AbraaoMarques\Correios\Api\SearchQuotationServiceInterface;

class Quotation
{
    public const METHOD_NAME_SEDEX = 'Sedex';
    public const METHOD_NAME_PAC = 'Pac';
    public const METHOD_PAC_CODE = '03298';
    public const METHOD_SEDEX_CODE = '03298';

    /**
     * @var Data
     */
    private $helper;

    /**
     * @var SearchQuotationServiceInterface
     */
    private $quotationService;

    /**
     * @param Data $helper
     * @param SearchQuotationServiceInterface $quotationService
     */
    public function __construct(
        Data $helper,
        SearchQuotationServiceInterface $quotationService
    ) {
        $this->helper = $helper;
        $this->quotationService = $quotationService;
    }

    /**
     * Método responsável por consumir a Service SearchQuotationService e retornar o resultado
     * das consultas nos Correios
     * @param $zipcode
     * @return array
     */
    public function search($zipcode)
    {
        return $this->quotationService->search($zipcode);
    }

    /**
     * Método responsável por montar o resultado de exibição (de quotação) na página do produto
     * @param $zipcode
     * @return string|null
     */
    public function inProductPage($zipcode)
    {
        $data = $this->search($zipcode);
        $count = count($data);
        $methodName = self::METHOD_NAME_SEDEX;
        $result = null;

        for ($i = 0; $i < $count; $i++) {
            if ($data[$i]['method'] == self::METHOD_NAME_PAC)
                $methodName = self::METHOD_NAME_PAC;

            $days = $data[$i]['deadline'];
            $addDays = $this->helper->getIncreaseDeliveryDays();

            if ($addDays)
                $days = $days + $addDays;

            $result .= "<span>{$methodName} - Em média {$days} dia(s) <strong>R$ {$data[$i]['price']}</strong></span>";
        }

        return $result;
    }
}
