<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function Merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function Order()
    {
        return $this->hasMany(Order::class);
    }
}
