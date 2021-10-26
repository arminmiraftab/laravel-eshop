<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    const STATUS_SUCCESS = 2;
    const STATUS_PENDING = 1;
    const STATUS_FAILED = 0;
    protected $table = 'transactions';
    protected $casts = ['transaction_result' => 'array'];
    protected $fillable = [
        'user_id',
        'Product_id',
        'payment_id',
        'paid',
        'status',
        'invoice_details',
        'transaction_id',
        'transaction_result',
    ];

    public function product()
    {
        return $this->belongsTo(products::class, 'Product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getInvoiceDetailsAttribute()
    {
        return unserialize($this->attributes['invoice_details']);
    }

    public function setInvoiceDetailsAttribute($value)
    {
        $this->attributes['invoice_details'] = serialize($value);
    }
}
