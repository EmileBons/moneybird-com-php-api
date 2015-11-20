<?php

namespace emilebons\moneybird\SalesInvoice;

use emilebons\moneybird\ConverterInterface;

class SalesInvoiceLineConverter implements ConverterInterface
{

    public function convert($object)
    {
        // TODO: Implement convert() method.
    }

    public function parse(array $array)
    {
        $line = new SalesInvoiceLine();
        $line->id = $array['id'];
        $line->taxRateId = $array['tax_rate_id'];
        $line->ledgerAccountId = $array['ledger_account_id'];
        $line->amount = $array['amount'];
        $line->description = $array['description'];
        $line->price = $array['price'];
        $line->rowOrder = $array['row_order'];
        $line->totalPriceExclTaxWithDiscount = $array['total_price_excl_tax_with_discount'];
        $line->totalPriceExclTaxWithDiscountBase = $array['total_price_excl_tax_with_discount_base'];
        $line->taxReportReference = $array['tax_report_reference'];
        $line->createdAt = $array['created_at'];
        $line->updatedAt = $array['updated_at'];
        return $line;
    }
}