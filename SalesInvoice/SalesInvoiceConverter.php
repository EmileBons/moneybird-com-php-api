<?php

namespace emilebons\moneybird\SalesInvoice;


use emilebons\moneybird\Contact;
use emilebons\moneybird\ConverterInterface;

class SalesInvoiceConverter implements ConverterInterface
{

    public function convert($object)
    {
        /** @var SalesInvoice $object */
        // TODO: Implement convert() method.
    }

    public function parse(array $array)
    {
        $salesInvoice = new SalesInvoice();
        $salesInvoice->id = $array['id'];
        $salesInvoice->contactId = $array['contact_id'];
        $salesInvoice->contact = (new Contact\ContactConverter())->parse($array['contact']);
        $salesInvoice->invoiceId = $array['invoice_id'];
        $salesInvoice->workflowId = $array['workflow_id'];
        $salesInvoice->documentStyleId = $array['document_style_id'];
        $salesInvoice->identityId = $array['identity_id'];
        $salesInvoice->state = $array['state'];
        $salesInvoice->invoiceDate = $array['invoice_date'];
        $salesInvoice->dueDate = $array['due_date'];
        $salesInvoice->paymentConditions = $array['payment_conditions'];
        $salesInvoice->reference = $array['reference'];
        $salesInvoice->language = $array['language'];
        $salesInvoice->currency = $array['currency'];
        $salesInvoice->discount = $array['discount'];
        $salesInvoice->originalSalesInvoiceId = $array['original_sales_invoice_id'];
        $salesInvoice->paidAt = $array['paid_at'];
        $salesInvoice->sentAt = $array['sent_at'];
        $salesInvoice->createdAt = $array['created_at'];
        $salesInvoice->updatedAt = $array['updated_at'];
        foreach($array['details'] as $lineArray)
        {
            $salesInvoice->lines[] = (new SalesInvoiceLineConverter())->parse($lineArray);
        }
        $salesInvoice->totalPaid = $array['total_paid'];
        $salesInvoice->totalUnpaid = $array['total_unpaid'];
        $salesInvoice->totalPriceExclTax = $array['total_price_excl_tax'];
        $salesInvoice->totalPriceExclTaxBase = $array['total_price_excl_tax_base'];
        $salesInvoice->totalPriceInclTax = $array['total_price_incl_tax'];
        $salesInvoice->totalPriceInclTaxBase = $array['total_price_incl_tax_base'];
        $salesInvoice->url = $array['url'];
        return $salesInvoice;
    }
}