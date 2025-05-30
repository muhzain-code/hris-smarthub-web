<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'assigned_to',
        'title',
        'description',
        'due_date',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }
}
