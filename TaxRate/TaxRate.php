<?php

namespace emilebons\moneybird\TaxRate;

class TaxRate
{
    /**
     * @var bool whether this tax rate is active
     */
    public $active;
    /**
     * @var string the date and time on which the tax rate has been created, e.g. "2015-11-25T14:24:05.726Z"
     */
    public $createdAt;
    /**
     * @var string the identifier, e.g. "140762335652349023"
     */
    public $id;
    /**
     * @var string the name, e.g. "21% btw"
     */
    public $name;
    /**
     * @var string the percentage, e.g. "21.0"
     */
    public $percentage;
    /**
     * @var bool whether tax rate should be visible on documents
     */
    public $showTax;
    /**
     * @var string the type, e.g. "sales_invoice"
     */
    public $type;
    /**
     * @var string the date and time ont which the tax rate has been last updated, e.g. "2015-11-25T14:24:05.726Z"
     */
    public $updatedAt;

}