<?php

namespace App\Http\Controllers;

use App\Models\PaymentPage;
use Illuminate\Http\Request;

class PaymentPageController extends Controller
{

    public function index()
    {
        $paymentPages = PaymentPage::all(); // Пример запроса, замените на вашу логику
        return view('payment_form', ['paymentPages' => $paymentPages]);
    }

    public function store(Request $request)
    {

        $subject = $request->input('subject');
        $description = $request->input('description');

        PaymentPage::createPage($subject, $description);

        return redirect()->route('admin.home')->with('success', 'Создана новая страница');
    }


}
