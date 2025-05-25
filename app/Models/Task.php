<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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
