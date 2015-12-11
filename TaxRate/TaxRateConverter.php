<?php

namespace emilebons\moneybird\TaxRate;


use emilebons\moneybird\ConverterInterface;

class TaxRateConverter implements ConverterInterface
{
    public function convert($object)
    {
        // TODO: Implement convert() method.
    }

    public function parse(array $array)
    {
        $taxRate = new TaxRate();
        $taxRate->id = $array['id'];
        $taxRate->name = $array['name'];
        $taxRate->percentage = $array['percentage'];
        $taxRate->type = $array['tax_rate_type'];
        $taxRate->showTax = $array['show_tax'];
        $taxRate->active = $array['active'];
        $taxRate->createdAt = $array['created_at'];
        $taxRate->updatedAt = $array['updated_at'];
        return $taxRate;
    }
}