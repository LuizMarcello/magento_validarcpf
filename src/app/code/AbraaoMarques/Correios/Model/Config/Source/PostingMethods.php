<?php

namespace AbraaoMarques\Correios\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PostingMethods implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                "value" => "03220",
                "label" => "Sedex Com Contrato (03220)"
            ],
            [
                "value" => "03298",
                "label" => "Pac Com Contrato (03298)"
            ]
        ];
    }
}
