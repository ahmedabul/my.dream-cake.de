<?php

namespace App\Http\Controllers;

use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;



class paypalController extends Controller
{
    private $gateway;
    public function __construct()
    {
        $this->gateway= Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AT85jR6arbzSCDwFLWBJ1xd01a3iKz9YNaZhtKTj8TTWh2T5awyuTbtAmw-BYvIpdirqsHHB48p7D-5Q');
        $this->gateway->setSecret('EDxFFJYkaZaAeaAKG7nmXoG8WOK8PbDtVtXKdKgRnybvALuofGOSiHUXF9VITp_-d0-V5CyDXgWE703t');
        $this->gateway->setTestMode(true);
    }
    public function index(Request $request)
    {
        $articles=articlesImCart();
        $mount=0;
        foreach($articles as $article => $articleData)
        {
            $mount+=$articleData['price']*$articleData['articleCount'];
        }

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $mount,
                'currency' => 'USD',
                'returnUrl' => Route('order.create',['deliveryAddressId'=>$request->deliveryAddressId]),
                'cancelUrl' =>Route('error.show',['sts'=>'Leider ist ein unerwarteter anwendungsfehler aufgetreten']),
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }else{
             return   $response->getMessage();
          
            }
        } catch (\Throwable $e) {
           print $e->getMessage();
     
        }
    }
}