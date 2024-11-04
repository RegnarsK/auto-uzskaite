<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['make', 'model', 'year'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
