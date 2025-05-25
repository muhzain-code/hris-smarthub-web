<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
     use HasFactory, SoftDeletes;

     protected $fillable = [
          'employee_id',
          'salary',
          'bonuses',
          'deductions',
          'net_pay',
          'pay_date',
     ];

     public function employee()
     {
          return $this->belongsTo(Employee::class, 'employee_id');
     }
}
