<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'status', 'img'];

    public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses_permissions');
    }
}
