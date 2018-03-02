<?php
namespace App;

use Endroid\QrCode\QrCode;

class Handler
{
    public function handle(string $_data) : void
    {
        $qrCode = new QrCode($_data);
        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
    }
}