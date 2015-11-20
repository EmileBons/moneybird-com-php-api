<?php

namespace emilebons\moneybird\Contact;

class Contact
{
    /**
     * @var string address line 1, i.e. "Hoofdstraat 12"
     */
    public $address1;
    /**
     * @var string address line 2
     */
    public $address2;
    /**
     * @var string
     */
    public $attention;
    /**
     * @var string the bank account number
     */
    public $bankAccount;
    /**
     * @var string the registration number at the chamber of commerce
     */
    public $chamberOfCommerce;
    /**
     * @var string the city, i.e. "Amsterdam"
     */
    public $city;
    /**
     * @var string the company name, i.e. "Foobar Holding B.V."
     */
    public $companyName;
    /**
     * @var string the country, i.e. "NL"
     */
    public $country;
    /**
     * @var string the date and time on which this contact was created, i.e. "2015-11-10T13:32:50.251Z"
     */
    public $createdAt;
    /**
     * @var string the number of the credit card
     */
    public $creditCardNumber;
    /**
     * @var string the reference of the credit card
     */
    public $creditCardReference;
    /**
     * @var string the type of the credit card
     */
    public $creditCardType;
    /**
     * @var integer the identifier of the customer, i.e. 1
     */
    public $customerId;
    /**
     * @var string the delivery method, i.e. "Email"
     */
    public $deliveryMethod;
    /**
     * @var string the email address, i.e. "info@example.com"
     */
    public $email;
    /**
     * @var string the first name of the contact
     */
    public $firstName;
    /**
     * @var integer the identifier, i.e. 139326370847130628
     */
    public $id;
    /**
     * @var string the last name of the contact
     */
    public $lastName;
    /**
     * @var string the phone number
     */
    public $phone;
    /**
     * @var string the name of the recipient for estimates
     */
    public $sendEstimatesToAttention;
    /**
     * @var string the email address of the recipient for estimates, i.e. "info@example.com"
     */
    public $sendEstimatesToEmail;
    /**
     * @var string the name of the recipient for invoices
     */
    public $sendInvoicesToAttention;
    /**
     * @var string the email address of the recipient for invoices, i.e. "info@example.com"
     */
    public $sendInvoicesToEmail;
    /**
     * @var boolean whether SEPA is active for this contact
     */
    public $sepaActive;
    /**
     * @var string the bank identifier code of the international bank account to be used for SEPA
     */
    public $sepaBic;
    /**
     * @var string the international bank account number to be used for SEPA
     */
    public $sepaIban;
    /**
     * @var string the name of the international bank account to be used for SEPA
     */
    public $sepaIbanAccountName;
    /**
     * @var string the date of the mandate to be used for SEPA
     */
    public $sepaMandateDate;
    /**
     * @var string the identifier of the mandate to be used for SEPA
     */
    public $sepaMandateId;
    /**
     * @var string the sequence type to be used for SEPA, i.e. "FRST"
     */
    public $sepaSequenceType;
    /**
     * @var string the VAT number
     */
    public $taxNumber;
    /**
     * @var string the date and time on which the VAT number was validated
     */
    public $taxNumberValidatedAt;
    /**
     * @var string the date and time on which this contact was updated, i.e. "2015-11-10T13:32:50.251Z"
     */
    public $updatedAt;
    /**
     * @var string ZIP code, i.e. "1234AB"
     */
    public $zipCode;
}