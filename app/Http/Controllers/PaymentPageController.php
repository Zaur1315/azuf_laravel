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

    public const FILE_NAME = 'payments-list';
    public function showPayments(PaymentPage $page): View|Application|Factory|\Illuminate\Http\JsonResponse|Application_Contracts
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
        return view('admin.action_payments', ['page'=>$page, 'filename'=>self::FILE_NAME]);
    }


}
