<?php

namespace emilebons\moneybird\SalesInvoice;

class SalesInvoiceLine
{
    /**
     * @var string the description of the amount, i.e. "1 x"
     */
    public $amount;
    /**
     * @var string the date and time of creation, i.e. "2015-11-10T13:32:50.314Z"
     */
    public $createdAt;
    /**
     * @var string the description, i.e. "Project X"
     */
    public $description;
    /**
     * @var integer the identifier, i.e. 139326370913190920
     */
    public $id;
    /**
     * @var integer the identifier of the general ledger account 139326003086361693
     */
    public $ledgerAccountId;
    /**
     * @var string the price, i.e. "300.0"
     */
    public $price;
    /**
     * @var integer the order of the row, i.e. 1
     */
    public $rowOrder;
    /**
     * @var integer the identifier of the tax rate, i.e. 139326003127256159
     */
    public $taxRateId;
    /**
     * @var array a description of tax report references, i.e. ["NL/1a"]
     */
    public $taxReportReference;
    /**
     * @var string the total price excluding tax with discount, i.e. "300.0"
     */
    public $totalPriceExclTaxWithDiscount;
    /**
     * @var string the total price excluding tax with discount, base rate, i.e. "300.0"
     */
    public $totalPriceExclTaxWithDiscountBase;
    /**
     * @var string the date and time of the last update, i.e. "2015-11-10T13:32:50.469Z"
     */
    public $updatedAt;

}