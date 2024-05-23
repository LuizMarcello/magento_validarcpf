<?php

namespace AbraaoMarques\Correios\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    const BASE_CONFIG_PATH = 'carriers/abraaomarques_correios/';
    const BASE_CONFIG_TOKEN_ENDPOINT = 'token/v1/autentica/cartaopostagem';
    const BASE_CONFIG_DEADLINE_ENDPOINT = 'prazo/v1/nacional/';
    const BASE_CONFIG_PRICE_ENDPOINT = 'preco/v1/nacional/';
    const BASE_VALUE_WEIGHT = 1;
    const BASE_VALUE_HEIGHT = 20;
    const BASE_VALUE_WIDTH = 20;
    const BASE_VALUE_LENGTH = 20;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(Context $context, ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @param $value
     * @return string|null
     */
    private function getValue($value): ?string
    {
        return $this->scopeConfig->getValue(self::BASE_CONFIG_PATH.$value, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string|null
     */
    public function getWebService(): ?string
    {
        return $this->getValue('webservice_url');
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->getValue('login');
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->getValue('password');
    }

    /**
     * @return string|null
     */
    public function getCodePost(): ?string
    {
        return $this->getValue('code_post');
    }

    /**
     * @return string|null
     */
    public function getPostingMethods(): ?string
    {
        return $this->getValue('posting_methods');
    }

    /**
     * @return string|null
     */
    public function getMaxWeight(): ?string
    {
        return $this->getValue('max_weight');
    }

    /**
     * @return int|null
     */
    public function getIncreaseDeliveryDays(): ?int
    {
        return $this->getValue('increase_delivery_days');
    }

    /**
     * @return float|null
     */
    private function getDefaultWeight(): ?float
    {
        return $this->getValue('default_weight');
    }

    /**
     * @return float|null
     */
    private function getDefaultWidth(): ?float
    {
        return $this->getValue('default_width');
    }

    /**
     * @return float|null
     */
    private function getDefaultHeight(): ?float
    {
        return $this->getValue('default_height');
    }

    /**
     * @return float|null
     */
    private function getDefaultLength(): ?float
    {
        return $this->getValue('default_length');
    }

    /**
     * @return string
     */
    private function getOriginPostCode(): string
    {
        return $this->scopeConfig->getValue('shipping/origin/postcode', ScopeInterface::SCOPE_STORE);
    }

    public function createTokenEndPoint()
    {
        return $this->getWebService().self::BASE_CONFIG_TOKEN_ENDPOINT;
    }

    /**
     * @param $zipcode
     * @param $method
     * @return string
     */
    public function createEndPointPrice($zipcode, $method): string
    {
        $webservice = $this->getWebService();
        $origin = $this->getOriginPostCode();
        $url = $webservice.self::BASE_CONFIG_PRICE_ENDPOINT;

        

        return $url.$method.'?cepOrigem='.$origin.'&cepDestino='.$zipcode.'&psObjeto=2&comprimento='.self::BASE_VALUE_LENGTH.'&largura='.self::BASE_VALUE_WIDTH.'&altura='.self::BASE_VALUE_HEIGHT;
       
    }

    /**
     * @param $zipcode
     * @param $method
     * @return string
     */
    public function createEndPointDeadLine($zipcode, $method): string
    {
        $webservice = $this->getWebService();
        $origin = $this->getOriginPostCode();
        $url = $webservice.self::BASE_CONFIG_DEADLINE_ENDPOINT;
        // var_dump($url);
        // die();

        return $url.$method.'?cepOrigem='.$origin.'&cepDestino='.$zipcode;
    }
}
