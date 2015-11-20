<?php

namespace emilebons\moneybird\SalesInvoice;

use emilebons\moneybird\BaseFactory;

class SalesInvoiceFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function __construct($administrationId, $client = null, $apiToken = null)
    {
        parent::__construct($administrationId, $client, $apiToken);
        $this->converter = new SalesInvoiceConverter();
        $this->apiSubUrl = 'sales_invoices';
    }
}