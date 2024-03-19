<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'service_transaction_details';

    protected $fillable = [
        'transaction_id',
        'service_id',
        'qty',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function Service()
    {
        return $this->belongsTo(Service::class);
    }
    public function employees()
{
    return $this->belongsToMany(Employee::class, 'employee_service');
}


}
