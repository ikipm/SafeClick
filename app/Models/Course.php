<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
    protected $fillable = ['locale', 'title', 'description'];
}

class CourseContent extends Model
{
    protected $fillable = ['locale', 'title', 'content'];
}

class Course extends Model
{
    protected $fillable = ['status', 'img'];

    public function translations()
    {
        return $this->hasMany(CourseTranslation::class);
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses_permissions');
    }
}
