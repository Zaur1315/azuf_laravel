<?php

namespace App\Http\Controllers;

use App\Models\DBdata;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminHome()
    {
        $data = DBdata::all();
        return view('admin/home', ['data'=>$data]);
    }

    public function createPaymentPage()
    {
        return view('admin/create_payment_page');
    }




}
