<?php

namespace App\Repositories;

use App\Models\Task;
use Exception;

class TaskRepository
{
    public function getByProject($projectId)
    {
        return Task::where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getById($id)
    {
        return Task::find($id);
    }

    public function create($data)
    {
        try {
            return Task::create($data);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $task = Task::find($id);

            if (!$task) return null;

            $task->update($data);

            return $task;
        } catch (Exception $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $task = Task::find($id);

            if (!$task) return null;

            $task->delete();

            return $task;
        } catch (Exception $e) {
            return null;
        }
    }
}