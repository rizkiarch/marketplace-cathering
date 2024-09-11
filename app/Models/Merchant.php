<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Products()
    {
        return $this->hasMany(Product::class);
    }

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
}
