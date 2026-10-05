<?php

namespace App\Repositories;

use App\Models\Project;
use Exception;

class ProjectRepository
{
    public function getByUser($userId)
    {
        return Project::with('category')
            ->where('owner_id', $userId)
            ->orWhereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orderBy('name')
            ->get();
    }

    public function getById($id)
    {
        return Project::with([
            'category',
            'owner',
            'users',
            'tasks'
        ])->find($id);
    }

    public function create($data)
    {
        try {
            return Project::create($data);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return null;
            }

            $project->update($data);

            return $project;
        } catch (Exception $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return null;
            }

            $project->delete();

            return $project;
        } catch (Exception $e) {
            return null;
        }
    }

    public function addUser($projectId, $userId)
    {
        try {
            $project = Project::find($projectId);

            if (!$project) {
                return null;
            }

            $project->users()->syncWithoutDetaching([$userId]);

            return $project;
        } catch (Exception $e) {
            return null;
        }
    }

    public function removeUser($projectId, $userId)
    {
        try {
            $project = Project::find($projectId);

            if (!$project) {
                return null;
            }

            $project->users()->detach($userId);

            return $project;
        } catch (Exception $e) {
            return null;
        }
    }
}