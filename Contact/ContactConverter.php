<?php

namespace emilebons\moneybird\Contact;

use emilebons\moneybird\ConverterInterface;

class ContactConverter implements ConverterInterface
{

    public function convert($object)
    {
        // TODO: Implement convert() method.
    }

    public function parse(array $array)
    {
        $contact = new Contact();
        $contact->id = $array['id'];
        $contact->companyName = $array['company_name'];
        $contact->firstName = $array['firstname'];
        $contact->lastName = $array['lastname'];
        $contact->attention = $array['attention'];
        $contact->address1 = $array['address1'];
        $contact->address2 = $array['address2'];
        $contact->zipCode = $array['zipcode'];
        $contact->city = $array['city'];
        $contact->country = $array['country'];
        $contact->email = $array['email'];
        $contact->phone = $array['phone'];
        $contact->deliveryMethod = $array['delivery_method'];
        $contact->customerId = $array['customer_id'];
        $contact->taxNumber = $array['tax_number'];
        $contact->chamberOfCommerce = $array['chamber_of_commerce'];
        $contact->bankAccount = $array['bank_account'];
        $contact->sendInvoicesToAttention = $array['send_invoices_to_attention'];
        $contact->sendInvoicesToEmail = $array['send_invoices_to_email'];
        $contact->sendEstimatesToAttention = $array['send_estimates_to_attention'];
        $contact->sendEstimatesToEmail = $array['send_estimates_to_email'];
        $contact->sepaActive = $array['sepa_active'];
        $contact->sepaIban = $array['sepa_iban'];
        $contact->sepaIbanAccountName = $array['sepa_iban_account_name'];
        $contact->sepaBic = $array['sepa_bic'];
        $contact->sepaMandateId = $array['sepa_mandate_id'];
        $contact->sepaMandateDate = $array['sepa_mandate_date'];
        $contact->sepaSequenceType = $array['sepa_sequence_type'];
        $contact->creditCardNumber = $array['credit_card_number'];
        $contact->creditCardReference = $array['credit_card_reference'];
        $contact->creditCardType = $array['credit_card_type'];
        $contact->taxNumberValidatedAt = $array['tax_number_validated_at'];
        $contact->createdAt = $array['created_at'];
        $contact->updatedAt = $array['updated_at'];
        return $contact;
    }
}