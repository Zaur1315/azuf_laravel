<?php

//Модель для базы данных payment_pages

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentPage extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'description', 'slug'];


    public function payments(): HasMany
    {
     return $this->hasMany(DBdata::class);
    }
}
