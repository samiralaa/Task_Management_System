<?php

namespace App\Services;

use App\Repositories\Interface\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        return $this->taskRepository->all();
    }

    public function getTaskById($id)
    {
        return $this->taskRepository->find($id);
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask($id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function updateStatus($data, $id)
    {
        $task = $this->taskRepository->find($id);

        if (!$task) {
            return ['error' => 'Task not found', 'status' => 404];
        }

        if ($data['status'] === 'completed') {
            $incompleteDependencies = $task->dependencies()->where('status', '!=', 'completed')->count();
            if ($incompleteDependencies > 0) {
                return ['error' => 'Cannot complete task until all dependencies are completed', 'status' => 400];
            }
        }

        $task->status = $data['status'];
        $task->save();

        return ['message' => 'Task status updated successfully', 'task' => $task, 'status' => 200];
    }

    public function deleteTask($id)
    {
        return $this->taskRepository->delete($id);
    }

    public function addTaskDependency($taskId, $dependencyId)
    {
        return $this->taskRepository->addDependency($taskId, $dependencyId);
    }
}
