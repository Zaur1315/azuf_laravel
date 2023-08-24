<?php

//Контроллер для создания заголовков для новых шаблонов платежных страниц

namespace App\Http\Controllers;



use App\Models\PaymentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentPageController extends Controller
{

    public function index()
    {
        $paymentPages = PaymentPage::all();
        return view('payment_form', ['paymentPages' => $paymentPages]);
    }

    public function store(Request $request)
    {
        $subject = $request->input('subject');
        $description = $request->input('description');

        $slug = Str::slug($subject);

        PaymentPage::create([
            'subject' => $subject,
            'description' => $description,
            'slug' => $slug,
        ]);



        return redirect()->route('admin.home')->with('success', 'Создана новая страница');
    }


}
