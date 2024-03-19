<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeService extends Model
{
    use HasFactory;

    protected $table = 'employee_service';

    protected $fillable = [
        'employee_id',
        'service_transaction_detail_id'
    ];

    #relationship

    // employee_id -> employees
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    // service_transaction_detail_id -> service_transaction_details
    public function serviceTransactionDetail()
    {
        return $this->belongsTo(ServiceTransactionDetail::class);
    }
}

