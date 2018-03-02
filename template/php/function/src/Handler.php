<?php
namespace App;

use Endroid\QrCode\QrCode;

class Handler
{
    public function handle(string $_data) : void
    {
        $qrCode = new QrCode($_data);
        echo base64_encode($qrCode->writeString());
    }
}
