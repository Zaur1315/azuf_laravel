<?php

namespace App\Http\Controllers;

use App\Models\PaymentPage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;

class ActionController extends Controller
{
    public const FILE_NAME = 'action-list';

    public function index(): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application

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
}
