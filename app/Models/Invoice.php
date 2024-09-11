<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'invoice_date' => 'datetime',
        'is_paid' => 'boolean',
    ];

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
