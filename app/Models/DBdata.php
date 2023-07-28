<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBdata extends Model
{
    use HasFactory;

    protected $table = 'payment_info';

    protected $fillable = [
                'public_id',
                'order_num',
                'order_status',
                'card',
                'date',
                'card_name',
                'customer_email',
                'customer_ip',
                'phone',
                'fin',
                'first_name',
                'last_name',
                'order_amount',
                'subject',
                'description',
    ];
}
