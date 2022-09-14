<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const CREATED = 'CREATED';
    const PAYED = 'PAYED';
    const REJECTED = 'REJECTED';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_mobile',
        'status',
        'request_id',
        'product_id',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
