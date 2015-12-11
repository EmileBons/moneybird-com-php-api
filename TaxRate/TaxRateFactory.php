<?php

namespace emilebons\moneybird\SalesInvoice;


use emilebons\moneybird\BaseFactory;
use emilebons\moneybird\TaxRate\TaxRateConverter;

class TaxRateFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function __construct($administrationId, $client = null, $apiToken = null)
    {
        parent::__construct($administrationId, $client, $apiToken);
        $this->converter = new TaxRateConverter();
        $this->apiSubUrl = 'tax_rates';
    }
}