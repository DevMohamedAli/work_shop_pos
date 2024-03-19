<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'product_transaction_details';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
