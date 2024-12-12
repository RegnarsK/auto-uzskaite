<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'make',
        'model',
        'year',
    ];

    /**
     * Get the tasks for the car.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the active tasks for the car.
     */
    public function activeTasks()
    {
        return $this->tasks()->whereIn('status', ['pending', 'assigned']);
    }

    /**
     * Get the completed tasks for the car.
     */
    public function completedTasks()
    {
        return $this->tasks()->where('status', 'completed');
    }
}
