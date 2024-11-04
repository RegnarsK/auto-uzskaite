<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['car_id', 'description', 'status'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tasks')->withTimestamps();
    }
}
