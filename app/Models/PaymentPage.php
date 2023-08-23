<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentPage extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'description', 'slug'];


    public static function createPage($subject, $description, $slug)
    {
        return DB::table('payment_pages')->insert([
            'subject' => $subject,
            'description' => $description,
            'slug' => $slug,
        ]);
    }


    public function payments()
    {
     return $this->hasMany(DBdata::class);
    }
}
