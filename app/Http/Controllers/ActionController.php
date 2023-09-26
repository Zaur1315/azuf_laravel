<?php

namespace App\Http\Controllers;

use App\Models\PaymentPage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ActionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $actions = PaymentPage::select('id', 'subject', 'description', 'created_at', 'slug', 'show')->get();

            return DataTables::of($actions)
                ->addColumn('action', function ($action) {
                    return '<a href="' . route('action.list', $action) . '" class="btn btn-primary btn-sm">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.action_list');
    }
}
