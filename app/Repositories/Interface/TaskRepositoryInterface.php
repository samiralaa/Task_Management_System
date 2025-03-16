<?php

namespace App\Repositories\Interface;

interface TaskRepositoryInterface extends BaseRepositoryInterface
{
    public function updateTaskStatus($id, $status);
    public function addDependency($taskId, $dependencyId);
}
