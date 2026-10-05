<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $repo;
    protected $projectRepo;

    public function __construct(
        TaskRepository $repo,
        ProjectRepository $projectRepo
    ) {
        $this->repo = $repo;
        $this->projectRepo = $projectRepo;
    }

    public function add($projectId)
    {
        $project = $this->projectRepo->getById($projectId);

        if (!$project) {
            return redirect()->route('projects.index');
        }

        $isMember = $project->owner_id === auth()->id()
            || $project->users->contains(auth()->id());

        if (!$isMember) {
            return redirect()->route('projects.index');
        }

        if ($project->isClosed()) {
            return redirect()->route('projects.show', $projectId);
        }

        return view('tasks.form', compact('project'));
    }

    public function insert(Request $request)
    {
        $project = $this->projectRepo->getById($request->project_id);

        if (!$project) {
            return redirect()->route('projects.index');
        }

        $isMember = $project->owner_id === auth()->id()
            || $project->users->contains(auth()->id());

        if (!$isMember) {
            return redirect()->route('projects.index');
        }

        if ($project->isClosed()) {
            return redirect()->route('projects.show', $project->id);
        }

        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'open';

        $task = $this->repo->create($data);

        if (!$task) {
            return back()->withErrors([
                'message' => 'No se ha podido crear la tarea.'
            ])->withInput();
        }

        return redirect()->route('projects.show', $project->id);
    }

    public function close($id)
    {
        $task = $this->repo->getById($id);

        if (!$task) {
            return redirect()->route('projects.index');
        }

        $project = $this->projectRepo->getById($task->project_id);

        $isMember = $project->owner_id === auth()->id()
            || $project->users->contains(auth()->id());

        if (!$isMember) {
            return redirect()->route('projects.index');
        }

        $this->repo->update($task->id, [
            'status' => 'closed'
        ]);

        return redirect()->route('projects.show', $project->id);
    }
}
