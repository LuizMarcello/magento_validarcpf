<?php

namespace AbraaoMarques\Correios\Api;

interface SearchQuotationServiceInterface
{
    /**
     * @param string $zipcode
     * @return array|null
     */
    public function search(string $zipcode): ?array;
}
