<?php
(error_reporting(-1));

function name_to_string($input_string)
{
    $translit = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ə' => 'a', 'ğ' => 'g',
        'ç' => 'ch', 'ö' => 'o', 'ş' => 'sh', 'ü' => 'u', 'ı' => 'i',
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
        'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
        'Ш' => 'Sh', 'Щ' => 'Sch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya', 'Ә' => 'A', 'Ğ' => 'G',
        'Ç' => 'Ch', 'Ö' => 'O', 'Ş' => 'Sh', 'Ü' => 'U', 'İ' => 'I',
    );
    $output_string = strtr($input_string, $translit);
    $output = preg_replace('/[^A-Za-zА-Яа-я]/u', '', $output_string);

    return $output;
}


$url = 'https://pay.xezine.az/api/v1/session';
//$merchant_key = 'adc58412-c406-11ed-85c2-c69e85a6e85d';
//$merchant_pass = 'b045abfd61d075fff377ae49f9905a09';
 $merchant_key = 'c0892a60-af39-11eb-affd-fac77cf0e095';
 $merchant_pass = '4793c81766b196912ec030fad06e9756';
$order_number = 'azuf_'.bin2hex(random_bytes(10));
$order_amount = number_format($_POST['payment'],2,'.','');;
$order_currency = 'AZN';
$order_description = $_POST['fin'] ? strtoupper($_POST['fin']) : 'Anonim';
$first_name = $_POST['first_name'] ? name_to_string($_POST['first_name']): 'Anonim';
$last_name = $_POST['last_name'] ? name_to_string($_POST['last_name']) : 'Anonim';
$customer_name = $first_name.' '.$last_name;

$fin = $_POST['fin'] ?: 'Anonim';

$true_first = $_POST['first_name'] ?: 'Anonim';
$true_last =  $_POST['last_name'] ?: 'Anonim';
$customer_email = $_POST['mail'] ?: 'azuf@gmail.com';
$cancel_url = 'https://azuf.e-xezine.az/cancel.php';
$success_url = 'https://azuf.e-xezine.az/success.php';



$billing_city = 'Los Angeles';
$billing_address = 'Moor Building 35274';
$billing_zip = $_POST['fin'] ?: 'Anonim' ;
$billing_phone = $_POST['phone'];
$billing_dist = 'Beverlywood';
$billing_house_number = '777';
$recurring_init = true;

$headers = array(
    'Content-Type: application/json',
    'Accept: application/json',
);

$to_md5 = strtoupper($order_number.$order_amount.$order_currency.$order_description.$merchant_pass);
$md5_hash = md5($to_md5);
$sha1_hash = sha1($md5_hash);
$session_hash = $sha1_hash;
var_dump($session_hash);

$payment_data = array(
    "merchant_key" => $merchant_key,
    "operation" => 'purchase',
    'methods' => array(),
    'order' => array(
        'number' => $order_number,
        'amount' => $order_amount,
        'currency' => $order_currency,
        'description' => $order_description
    ),
    'cancel_url' => $cancel_url,
    'success_url' => $success_url,
    'customer' => array('name' => $customer_name, 'email' => $customer_email),
    "billing_address" => array(
        "country" => 'US',
        "state" => $true_first,
        "city" => $true_last,
        "district" => $billing_dist,
        "address" => $billing_phone,
        "house_number" => $billing_house_number,
        "zip" =>  $fin,
        "phone" => $billing_phone
    ),
    'hash' => $session_hash
);

$data = json_encode($payment_data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$json_response = json_decode($response, true);
if (isset($json_response['redirect_url'])) {
    header('Location: ' . $json_response['redirect_url']);
    exit;
} else {
    var_dump($json_response);
    echo 'Error: redirect URL not found in response';
}



