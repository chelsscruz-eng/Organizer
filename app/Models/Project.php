<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'code',
        'name',
        'description',
        'category_id',
        'owner_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function isClosed()
    {
        return $this->tasks->count() > 0
            && $this->tasks->where('status', 'open')->count() === 0;
    }
}
