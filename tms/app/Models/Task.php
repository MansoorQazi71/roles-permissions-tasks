<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'user_id', // Don't forget to include user_id in fillable
    ];

    // Define the dates attribute
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

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
