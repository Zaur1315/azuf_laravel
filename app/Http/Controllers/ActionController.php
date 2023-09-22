<?php

namespace App\Http\Controllers;

use App\Models\PaymentPage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActionController extends Controller
{
    public function index(): View
    {
        $actions = PaymentPage::paginate(10);

        return view('admin.action_list')->with('actions', $actions);
    }
}
