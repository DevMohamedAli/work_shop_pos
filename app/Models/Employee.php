<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'specialization', 'phone', 'relatives_phone', 'blood_type', 'address', 'commission_rate'];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function serviceTransactionDetails()
{
    return $this->belongsToMany(ServiceTransactionDetail::class, 'employee_service');
}
}
