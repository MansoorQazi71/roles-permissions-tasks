<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
    ];

    protected $dates = ['due_date'];

    // Define priority levels as constants
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';

    // Define status options as constants
    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    // Accessor for priority
    public function getPriorityAttribute($value)
    {
        return ucfirst($value);
    }

    // Accessor for status
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
}
