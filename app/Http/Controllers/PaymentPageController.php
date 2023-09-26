<?php

//Контроллер для создания заголовков для новых шаблонов платежных страниц

namespace App\Http\Controllers;

use App\Models\DBdata;
use App\Models\PaymentPage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Illuminate\Contracts\Foundation\Application as Application_Contracts;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\DataTables;

class PaymentPageController extends Controller
{

    public function index(): View|Application|Factory|Application_Contracts
    {
        $paymentPages = PaymentPage::all();
        return view('payment_form', ['paymentPages' => $paymentPages]);
    }

    public function store(Request $request): RedirectResponse
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

    public function showPayments(PaymentPage $page)
    {
        if (request()->ajax()) {
            $payments = DBdata::where('payment_page_id', $page->id)
                ->select('first_name', 'last_name', 'order_amount', 'customer_email', 'phone', 'fin', 'date')
                ->get();

            return Datatables::of($payments)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.action_payments', compact('page'));
    }


}
