<?php

namespace App\Services\ccavenue\helpers;

use Illuminate\Http\Response;
use App\Services\ccavenue\helpers\CCCrypto;



class CCResponse extends PaymentConstants
{


    private string $data;
    private string $orderId;
    public function __construct(
        $data,
        $orderId,
    ) {
        $this->data = $data;
        $this->orderId = $orderId;
        parent::__construct();
    }


    public function rendered(): Response
    {

        return  response($this->generateHtml(), 200)->header('Content-Type', 'text/html');
    }

    public function data()
    {
        $data = [];
        parse_str($this->data, $data);
        return $data;
    }


    public function enc_data()
    {
        $ccCrypto = new CCCrypto();
        return $ccCrypto->encrypt($this->data);
    }

    public function rawHtml()
    {
        return $this->generateHtml();
    }

    public function orderId(): string
    {
        return $this->orderId;
    }

    private function generateHtml(): string
    {
        $ccCrypto = new CCCrypto();
        $encryptedData = $ccCrypto->encrypt($this->data);
        $mode = (env('CC_MODE') === 'test') ? 'test' : 'secure';
        $html = <<<HTML
        <form method="post" name="redirect"
            action="https://$mode.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
            <input type=hidden name=encRequest value="$encryptedData">
            <input type=hidden name=access_code value="$this->accessCode">
        </form>
        <script language='javascript'>
            document.redirect.submit();
        </script>
        HTML;
        return $html;
    }
}
