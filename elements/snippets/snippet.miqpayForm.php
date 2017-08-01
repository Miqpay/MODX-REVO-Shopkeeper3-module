<?php
if($_SESSION['shk_lastOrder']['payment'] == 'miqpay'){
    require MODX_CORE_PATH."components/miqpay/custom/php-sdk/MiqPay.php";

    $publicKey = '';
    $secretKey = '';
    $language = 'ru';
    $resultUrl = '';
    $failUrl = '';

    $params['amount'] = str_replace(',', '.', $_SESSION['shk_lastOrder']['price']);
    $params['currency'] = $_SESSION['shk_lastOrder']['currency'];
    $params['orderId'] = $_SESSION['shk_lastOrder']['id'];
    $params['paymentType'] = 'app';
    $params['payment'] = 'ALL';
    $params['language'] = $language;
    $params['resultUrl'] = $resultUrl;
    $params['failUrl'] = $failUrl;

    $miqPay = new MiqPay($publicKey,$secretKey);
    $response = $miqPay->api('initPayment', $params);

    if(!empty($response->result->payUrl)){
        header("Location: " . $response->result->payUrl);
    }
}
