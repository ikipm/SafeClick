<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $fillable = ['locale', 'title', 'description', 'content'];
}

class News extends Model
{
    use HasFactory;

    protected $fillable = ['img', 'url'];

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class);
    }
}
