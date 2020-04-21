<?php

namespace App\Hocs\Payments;

class Napas {

    const URL_PAYMENT = 'https://sandbox.napas.com.vn/gateway/vpcpay.do';

    protected $vpc_Version = '2.0';

    protected $vpc_Command = 'pay';

    protected $vpc_AccessCode = 'd03due3';

    protected $vpc_MerchTxnRef = 'Test1234/1';

    protected $vpc_Merchant = 'TESTMERCHANT01';

    protected $vpc_OrderInfo = 'Test1234';

    protected $vpc_Amount = '59954';

    protected $vpc_ReturnURL;

    protected $vpc_BackURL;

    protected $vpc_Locale = 'vn';

    protected $vpc_CurrencyCode = 'VND';

    protected $vpc_TicketNo = '125.212.228.248';

    protected $vpc_PaymentGateway = 'ATM';

    protected $vpc_CardType = 'VISA';

    protected $vpc_SecureHash;

    public function setVersion($version)
    {
        $this->vpc_Version = $version;
    }

    public function getVersion()
    {
        return $this->vpc_Version;
    }

    public function setCommand($command)
    {
        $this->vpc_Command = $command;
    }

    public function getCommand()
    {
        return $this->vpc_Command;
    }

    public function setAccessCode($code)
    {
        $this->vpc_AccessCode = $code;
    }

    public function getAccessCode()
    {
        return $this->vpc_AccessCode;
    }

    public function setMerchTxnRef($tnx)
    {
        $this->vpc_MerchTxnRef = $tnx;
    }

    public function getMerchTxnRef() {
        return $this->vpc_MerchTxnRef;
    }

    public function setMerchant($merchant)
    {
        $this->vpc_Merchant = $merchant;
    }

    public function getMerchant()
    {
        return $this->vpc_Merchant;
    }

    public function setOrderInfo($info)
    {
        $this->vpc_OrderInfo = $info;
    }

    public function getOrderInfo()
    {
        return $this->vpc_OrderInfo;
    }

    public function setAmount($amount)
    {
        $this->vpc_Amount = $amount;
    }

    public function getAmount()
    {
        return $this->vpc_Amount;
    }

    public function setReturnUrl($url)
    {
        $this->vpc_ReturnURL = $url;
    }

    public function getReturnUrl()
    {
        return $this->vpc_ReturnURL;
    }

    public function setBackUrl($url)
    {
        $this->vpc_BackURL = $url;
    }

    public function getBackUrl()
    {
        return $this->vpc_BackURL;
    }

    public function setLocale($locale)
    {
        $this->vpc_Locale = $locale;
    }

    public function getLocale()
    {
        return $this->vpc_Locale;
    }

    public function setCurrencyCode($code)
    {
        $this->vpc_CurrencyCode = $code;
    }

    public function getCurrencyCode()
    {
        return $this->vpc_CurrencyCode;
    }

    public function setTicketNo($no)
    {
        $this->vpc_TicketNo = $no;
    }

    public function getTicketNo()
    {
        return $this->vpc_TicketNo;
    }

    public function setPaymentGateWay($gateWay)
    {
        $this->vpc_PaymentGateway = $gateWay;
    }

    public function getPaymentGateWay()
    {
        return $this->vpc_PaymentGateway;
    }

    public function setCardType($type)
    {
        $this->vpc_CardType = $type;
    }

    public function getCardType()
    {
        return $this->vpc_CardType;
    }

    public function setSecureHash($hash)
    {
        $this->vpc_SecureHash = $hash;
    }

    public function getSecureHash()
    {
        return $this->vpc_SecureHash;
    }

    public function request()
    {
        return redirect()->to($this->getRequestUrl());
    }

    public function getParams()
    {
        return [
            'vpc_Version'        => $this->getVersion(),
            'vpc_Command'        => $this->getCommand(),
            'vpc_AccessCode'     => $this->getAccessCode(),
            'vpc_MerchTxnRef'    => $this->getMerchTxnRef(),
            'vpc_Merchant'       => $this->getMerchant(),
            'vpc_OrderInfo'      => $this->getOrderInfo(),
            'vpc_Amount'         => $this->getAmount(),
            'vpc_ReturnURL'      => $this->getReturnUrl(),
            'vpc_BackURL'        => $this->getBackUrl(),
            'vpc_Locale'         => $this->getLocale(),
            'vpc_CurrencyCode'   => $this->getCurrencyCode(),
            'vpc_TicketNo'       => $this->getTicketNo(),
            'vpc_PaymentGateway' => $this->getPaymentGateWay(),
            'vpc_CardType'       => $this->getCardType(),
            'vpc_SecureHash'     => $this->getSecureHash()
        ];
    }


    public function getRequestUrl()
    {
        $params = $this->getParams();
        $url = self::URL_PAYMENT . '?' . http_build_query($params);
        return urldecode($url);
        return $url;
    }
}