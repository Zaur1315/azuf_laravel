<?php

//Вывод всех записей на домашнюю страницу Админки

namespace App\Http\Controllers;

use App\Models\DBdata;
use App\Models\PaymentPage;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use TCPDF;
use Yajra\DataTables\DataTables;

use function Laravel\Prompts\password;


class AdminController extends Controller
{
    public const FILE_NAME = 'payments';

    public function adminHome(Request $request): JsonResponse|View
    {
        if ($request->ajax()) {
            $data = DBdata::select(
                'first_name',
                'last_name',
                'order_amount',
                'customer_email',
                'phone',
                'fin',
                'subject',
                'date'
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin/home')->with('filename', self::FILE_NAME);
    }

    public function getData(Request $request): JsonResponse
    {
        $sortBy = $request->input('sort');
        $direction = $request->input('direction');
        $filter = $request->input('filter');

        $query = DBdata::query();

        if ($sortBy) {
            if ($direction === 'asc') {
                $query->orderBy($sortBy);
            } elseif ($direction === 'desc') {
                $query->orderByDesc($sortBy);
            }
        }

        if ($filter) {
            $query->where('name', 'like', '%' . $filter . '%');
        }

        $data = $query->paginate(2);

        return response()->json($data);
    }

    public function actionList(): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (request()->ajax()) {
            $actions = PaymentPage::select('id', 'subject', 'description', 'created_at', 'slug', 'show')->get();

            return DataTables::of($actions)
                ->addColumn('action', function ($action) {
                    return '<a href="' . route(
                            'payment-pages.payment',
                            $action->id
                        ) . '" class="btn btn-primary btn-sm">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.action_list')->with('filename', self::FILE_NAME);
    }


    public function createPaymentPage(): View
    {
        return view('admin/create_payment_page');
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

        return redirect()->route('action.list')->with('success', 'Создана новая страница');
    }


    public function editPaymentPage($id): View
    {
        $paymentPage = PaymentPage::findOrFail($id);
        return view('admin.edit_payment_page', compact('paymentPage'));
    }


    public function updatePaymentPage(Request $request, $id): RedirectResponse
    {
        $paymentPage = PaymentPage::findOrFail($id);
        $paymentPage->subject = $request->input('subject');
        $paymentPage->description = $request->input('description');
        if ($request->input('show')) {
            $paymentPage->show = true;
        } else {
            $paymentPage->show = false;
        }

        $paymentPage->save();

        return redirect()->route('action.list')->with('success', 'Страница успешно изменена');
    }



}
