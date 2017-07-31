<?php
if($_SESSION['shk_lastOrder']['payment'] == 'miqpay'){
    require MODX_CORE_PATH."components/miqpay/custom/php-sdk/MiqPay.php";

    $publicKey = '';
    $secretKey = '';
    $language = 'ru';
    $result_url = '';
    $fail_url = '';

    $params['amount'] = str_replace(',', '.', $_SESSION['shk_lastOrder']['price']);
    $params['currency'] = $_SESSION['shk_lastOrder']['currency'];
    $params['orderId'] = $_SESSION['shk_lastOrder']['id'];
    $params['paymentType'] = 'app';
    $params['payment'] = 'ALL';
    $params['language'] = $language;
    $params['result_url'] = $result_url;
    $params['fail_url'] = $fail_url;

    $miqPay = new MiqPay($publicKey,$secretKey);
    $response = $miqPay->api('initPayment', $params);

    if(!empty($response->result->payUrl)){
        header("Location: " . $response->result->payUrl);
    }
}