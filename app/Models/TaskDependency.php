<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDependency extends Model
{

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function dependencyTask()
    {
        return $this->belongsTo(Task::class, 'dependency_task_id');
    }
}
