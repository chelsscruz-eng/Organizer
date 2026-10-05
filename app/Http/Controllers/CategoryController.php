<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $categories = $this->repo->getAll();

        return view('categories.index', compact('categories'));
    }

    public function add()
    {
        return view('categories.form', [
            'mode' => 'add'
        ]);
    }

    public function insert(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $category = $this->repo->create($data);

        if (!$category) {
            return back()->withErrors([
                'message' => 'No se ha podido crear la categoría.'
            ])->withInput();
        }

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->repo->getById($id);

        if (!$category) {
            return redirect()->route('categories.index');
        }

        return view('categories.form', [
            'mode' => 'edit',
            'category' => $category
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $category = $this->repo->update($request->id, $data);

        if (!$category) {
            return back()->withErrors([
                'message' => 'No se ha podido actualizar la categoría.'
            ])->withInput();
        }

        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $category = $this->repo->delete($id);

        if (!$category) {
            return redirect()->route('categories.index');
        }

        return redirect()->route('categories.index');
    }
}
