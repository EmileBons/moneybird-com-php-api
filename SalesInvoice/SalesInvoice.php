<?php

namespace emilebons\moneybird\SalesInvoice;

use emilebons\moneybird\Contact;

class SalesInvoice
{
    /**
     * @var Contact\Contact
     */
    public $contact;
    /**
     * @var integer the identifier of the contact, i.e. 139326370847130628
     */
    public $contactId;
    /**
     * @var string the date on which the invoice was created, i.e. "2015-11-10T13:32:50.311Z"
     */
    public $createdAt;
    /**
     * @var string the currency code, i.e. "EUR"
     */
    public $currency;
    /**
     * @var string the discount, i.e. "0.0"
     */
    public $discount;
    /**
     * @var integer the identifier of the document style, i.e. 139326003435537520
     */
    public $documentStyleId;
    /**
     * @var string the date on which the invoice is due, i.e. "2015-11-24"
     */
    public $dueDate;
    /**
     * @var integer the identifier, for example 139326370910045191
     */
    public $id;
    /**
     * @var integer the identifier of the identity, i.e. 139326003178636389
     */
    public $identityId;
    /**
     * @var string the invoice number, i.e. "2015-0001"
     */
    public $invoiceId;
    /**
     * @var string the date of the invoice, i.e. "2015-11-10"
     */
    public $invoiceDate;
    /**
     * @var SalesInvoiceLine[] the lines of the sales invoice
     */
    public $lines = [];
    /**
     * @var string the language of the invoice, i.e. "nl"
     */
    public $language;
    /**
     * @var integer the original sales invoice identifier, in the case of a credit invoice, i.e. 139400223322539015
     */
    public $originalSalesInvoiceId;
    /**
     * @var string the date on which the invoice was paid
     */
    public $paidAt;
    /**
     * @var string the description of the payment conditions, i.e. "We verzoeken u vriendelijk het bovenstaande bedrag
     * van {document.total_price} voor {document.due_date} te voldoen op onze bankrekening onder vermelding van het
     * factuurnummer {document.invoice_id}. Voor vragen kunt u contact opnemen per e-mail."
     */
    public $paymentConditions;
    /**
     * @var string the description of the reference, i.e. "Project X"
     */
    public $reference;
    /**
     * @var string the date on which the invoice was sent, i.e. "2015-11-10"
     */
    public $sentAt;
    /**
     * @var string the status of the invoice, i.e. "open"
     */
    public $state;
    /**
     * @var string the total amount paid, i.e. "0.0"
     */
    public $totalPaid;
    /**
     * @var string the total price excluding tax, i.e. "300.0"
     */
    public $totalPriceExclTax;
    /**
     * @var string the total price excluding tax, base rate, i.e. "300.0"
     */
    public $totalPriceExclTaxBase;
    /**
     * @var string the total price including tax, i.e. "363.0"
     */
    public $totalPriceInclTax;
    /**
     * @var string the total price including tax, base rate, i.e. "363.0"
     */
    public $totalPriceInclTaxBase;
    /**
     * @var string the total amount unpaid, i.e. "363.0"
     */
    public $totalUnpaid;
    /**
     * @var string the date and time on which the invoice was last updated, i.e. "2015-11-10T13:32:50.478Z"
     */
    public $updatedAt;
    /**
     * @var string the location on which the sales invoice can be found
     */
    public $url;
    /**
     * @var integer the identifier of the workflow, i.e. 139326003273008230
     */
    public $workflowId;

    /**
     * @return \DateTime the due date as a DateTime object
     */
    public function getDueDateTime()
    {
        return \DateTime::createFromFormat('Y-m-d', $this->dueDate);
    }

    /**
     * @return \DateTime the invoice date as a DateTime object
     */
    public function getInvoiceDateTime()
    {
        return \DateTime::createFromFormat('Y-m-d', $this->invoiceDate);
    }

}