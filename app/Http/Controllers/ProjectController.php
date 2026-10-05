<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $repo;
    protected $categoryRepo;

    public function __construct(
        ProjectRepository $repo,
        CategoryRepository $categoryRepo
    ) {
        $this->repo = $repo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $projects = $this->repo->getByUser(auth()->id());

        return view('projects.index', compact('projects'));
    }

    public function add()
    {
        $categories = $this->categoryRepo->getAll();

        return view('projects.form', [
            'mode' => 'add',
            'categories' => $categories
        ]);
    }

    public function insert(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|max:255|unique:projects,code',
            'name' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data['owner_id'] = auth()->id();

        $project = $this->repo->create($data);

        if (!$project) {
            return back()->withErrors([
                'message' => 'No se ha podido crear el proyecto.'
            ])->withInput();
        }

        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $project = $this->repo->getById($id);

        if (!$project) {
            return redirect()->route('projects.index');
        }

        $isMember = $project->owner_id === auth()->id()
            || $project->users->contains(auth()->id());

        if (!$isMember) {
            return redirect()->route('projects.index');
        }

        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = $this->repo->getById($id);

        if (!$project || $project->owner_id !== auth()->id()) {
            return redirect()->route('projects.index');
        }

        $categories = $this->categoryRepo->getAll();

        return view('projects.form', [
            'mode' => 'edit',
            'project' => $project,
            'categories' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $project = $this->repo->getById($request->id);

        if (!$project || $project->owner_id !== auth()->id()) {
            return redirect()->route('projects.index');
        }

        $data = $request->validate([
            'code' => 'required|max:255|unique:projects,code,' . $project->id,
            'name' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $updated = $this->repo->update($project->id, $data);

        if (!$updated) {
            return back()->withErrors([
                'message' => 'No se ha podido actualizar el proyecto.'
            ])->withInput();
        }

        return redirect()->route('projects.show', $project->id);
    }

    public function delete($id)
    {
        $project = $this->repo->getById($id);

        if (!$project || $project->owner_id !== auth()->id()) {
            return redirect()->route('projects.index');
        }

        $this->repo->delete($id);

        return redirect()->route('projects.index');
    }

    public function members($id)
    {
        $project = $this->repo->getById($id);
        if (!$project || $project->owner_id !== auth()->id()) {
            return redirect()->route('projects.index');
        }
        $users = \App\Models\User::where('id', '!=', auth()->id())->get();

        return view('projects.members', compact('project', 'users'));
    }

    public function addMember(Request $request, $id)
    {
        $project = $this->repo->getById($id);
        if (!$project || $project->owner_id !== auth()->id()) {
            return redirect()->route('projects.index');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $project->users()->syncWithoutDetaching([$request->user_id]);
        return redirect()->route('projects.show', $id);
    }

    public function removeMember($projectId, $userId)
    {
        $project = $this->repo->getById($projectId);

        if (!$project || $project->owner_id !== auth()->id()) {
            return redirect()->route('projects.index');
        }
        $project->users()->detach($userId);
        return redirect()->route('projects.show', $projectId);
    }
}
