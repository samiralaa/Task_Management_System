<?php

namespace App\Http\Controllers\Api\Task;

use App\Services\TaskService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskDependencyRequest;

class TaskController extends Controller
{
    use ApiResponseTrait;

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        try {
            $tasks = $this->taskService->getAllTasks();
            return $this->successResponse($tasks, 'Tasks retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve tasks.', 500);
        }
    }

    public function show($id)
    {
        try {
            $task = $this->taskService->getTaskById($id);
            if (!$task) {
                return $this->errorResponse('Task not found.', 404);
            }
            return $this->successResponse($task, 'Task details retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve task.', 500);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            $task = $this->taskService->createTask($request->validated());
            return $this->successResponse($task, 'Task created successfully.', 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create task.', 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $response = $this->taskService->updateStatus($request->all(), $id);

            if (isset($response['error'])) {
                return response()->json(['error' => $response['error']], $response['status']);
            }

            return response()->json(['message' => $response['message'], 'task' => $response['task']], $response['status']);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update task status.', 500);
        }
    }

    public function addDependency(TaskDependencyRequest $request, $id)
    {
        try {
            $response = $this->taskService->addTaskDependency($id, $request->dependency_id);
            return $this->successResponse($response, 'Dependency added successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add dependency.', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->taskService->deleteTask($id);
            return $this->successResponse([], 'Task deleted successfully', 204);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete task.', 500);
        }
    }
}
