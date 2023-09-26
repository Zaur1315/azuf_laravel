<?php

namespace App\Http\Controllers;

use App\Models\DBdata;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DBdata::select('first_name', 'last_name', 'order_amount', 'customer_email', 'phone', 'fin', 'subject')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('test');
    }
}
