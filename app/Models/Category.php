<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'color'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
