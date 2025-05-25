<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presence extends Model
{
     use HasFactory, SoftDeletes;

     protected $fillable = [
          'employee_id',
          'check_in',
          'check_out',
          'date',
          'status',
     ];

     public function employee()
     {
          return $this->belongsTo(Employee::class, 'employee_id');
     }
}
