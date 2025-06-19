<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
//echo $_SERVER['DOCUMENT_ROOT'] . '/ADMIN/PHP/MYF1.php';
//include_once($_SERVER['DOCUMENT_ROOT'] . '/ADMIN/PHP/MYF1.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/PHP/MYF1.php');


    function createStripePaymentLink($productData) {
        \Stripe\Stripe::setApiKey('sk_test_ZrX77nHXoVge9uHFlssXjQZ8');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $productData['currency'],
                    'product_data' => [
                        'name' => $productData['name'],
                    ],
                    'unit_amount' => $productData['amount'],
                ],
                'quantity' => $productData['quantity'],
            ]],
            'mode' => 'payment',
            'success_url' => $productData['success_url'],
            'cancel_url' => $productData['cancel_url'],
        ]);

        return $session->url;
    }
    

    $productData = [
        'currency' => 'mxn',
        'name' => 'T-shirt',
        'amount' => 2000, // amount in cents
        'quantity' => 1,
        'success_url' => 'https://your-website.com/success',
        'cancel_url' => 'https://your-website.com/cancel',
    ];

    $link = createStripePaymentLink($productData);
    echo $link;
?>