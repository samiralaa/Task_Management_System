<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'due_date', 'assignee_id', 'created_by_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function dependencies()
    {
        return $this->belongsToMany(Task::class, 'task_dependencies', 'task_id', 'dependency_task_id');
    }
}
