<?php

namespace App\Services\ccavenue\helpers;


abstract class PaymentConstants
{
    protected string $workingKey;
    protected string $accessCode;
    protected string $merchantId;
    protected string $language;
    protected string $currency;

    public function __construct(
        ?string $language = "EN",
        ?string $currency = "INR",
    ) {
        $this->workingKey = env('CC_WORKING_KEY');
        $this->accessCode = env('CC_ACCESS_CODE');
        $this->merchantId = env('CC_MERCHANT_ID');
        $this->language = $language;
        $this->currency = $currency;
    }
}
