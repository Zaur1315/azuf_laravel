<?php

namespace Database\Seeders;

use App\Models\DBdata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DBdata::create([
            'public_id'=>'123',
            'order_num'=>'djlkasjdklsajd',
            'order_status'=>'success',
            'card'=>'2345678',
            'date'=>'gfdgf',
            'card_name'=>'fsdfsf',
            'customer_email'=>'dshgdfvv',
            'customer_ip'=>'fdsdfsgfd',
            'phone'=>'gfdbhzvcx',
            'fin'=>'asfdgg',
            'first_name'=>'fdffd',
            'last_name'=>'dsfhgfbvzx',
            'order_amount'=>'1000',
            'subject'=>'wqeczx',
            'description'=>'grt',
        ]);
    }
}
