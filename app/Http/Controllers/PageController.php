<?php

namespace App\Http\Controllers;

use App\Models\PaymentPage;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use \Illuminate\Contracts\View\View;
use \Illuminate\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\Foundation\Application as Application_Foundation;

class PageController extends Controller
{

    public function showFirstPage(): View|Application|Factory|Application_Foundation
    {
        return view('payment_form');
    }


    public function showPage($slug): Application_Foundation|View
    {
        $page = PaymentPage::where('slug', $slug)->firstOrFail();

        return view('show', ['page' => $page]);
    }

    public function processPayment( Request $request): RedirectResponse
    {
        function name_to_string($input_string): array|string|null
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
        $merchant_key = '98aa0d14-1d44-11ed-ba01-e62d6d068e9c';
        $merchant_pass = '4793c81766b196912ec030fad06e9756';
        $order_number = 'azuf_'.bin2hex(random_bytes(10));
        $order_amount = number_format($_POST['payment'],2,'.','');;
        $order_currency = 'AZN';
        $order_description = $request->input('fin') ? strtoupper($request->input('fin')) : 'Anonim';
        $first_name = $request->input('first_name') ? name_to_string($request->input('first_name')): 'Anonim';
        $last_name = $request->input('last_name') ? name_to_string($request->input('last_name')) : 'Anonim';
        $customer_name = $first_name.' '.$last_name;

        $fin = $request->input('fin') ?: 'Anonim';

        $true_first = $request->input('first_name') ?: 'Anonim';
        $true_last =  $request->input('last_name') ?: 'Anonim';
        $customer_email = $request->input('mail') ?: 'azuf@gmail.com';
        $cancel_url = 'https://azuf.e-xezine.az/cancel.php';
        $success_url = 'https://azuf.e-xezine.az/success.php';



        $billing_city = 'Los Angeles';
        $billing_address = 'Moor Building 35274';
        $billing_zip = $request->input('fin') ?: 'Anonim' ;
        $billing_phone = $request->input('phone') ?: '123456';
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
//        var_dump($session_hash);

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


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, $payment_data);

        if ($response->successful() && isset($response['redirect_url'])) {
            // Оплата успешно инициирована, перенаправляем пользователя на страницу оплаты
            return redirect()->away($response['redirect_url']);
        } else {
            // Произошла ошибка при инициировании оплаты, обработайте её соответственно
            // dd($response);
            return back()->with('error', 'Ошибка при инициировании оплаты. Пожалуйста, попробуйте еще раз.');
        }


    }

    public function handleNotification(Request $request): Application|Response|JsonResponse|Application_Foundation|ResponseFactory
    {

        $data = $request->all();

        try {
            DB::table('payment_info')->insert([
                'publicID' => $data['id'],
                'order_num' => $data['order_number'],
                'order_amount' => $data['order_amount'],
                'order_status' => $data['status'],
                'card' => $data['card'],
                'date' => $data['date'],
                'card_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_ip' => $data['customer_ip'],
                'first_name' => $data['customer_city'],
                'last_name' => $data['customer_state'],
                'phone' => $data['customer_address'],
                'fin' => $data['order_description'],
                'subject'=> 'subject',
                'description' => 'description',
                'payment_page_id' => '1'
            ]);
            return response()->json(['status'=>'success']);
        } catch (\Exception $e){
            dump($e);
            return response();
        }
    }
}
