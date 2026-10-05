<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $users = $this->repo->getAll();
        return view('users.index', compact('users'));
    }

    public function add()
    {
        return view('users.form', [
            'mode' => 'add'
        ]);
    }

    public function insert(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'email' => 'nullable|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'type' => 'required|in:admin,operator',
        ]);

        $user = $this->repo->create($data);

        if (!$user) {
            return back()->withErrors([
                'message' => 'No se ha podido crear el usuario.'
            ])->withInput();
        }

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = $this->repo->getById($id);

        if (!$user) {
            return redirect()->route('users.index');
        }

        return view('users.form', [
            'mode' => 'edit',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $data = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'type' => 'required|in:admin,operator',
        ]);

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $user = $this->repo->update($id, $data);

        if (!$user) {
            return back()->withErrors([
                'message' => 'No se ha podido actualizar el usuario.'
            ])->withInput();
        }

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        $user = $this->repo->delete($id);

        if (!$user) {
            return redirect()->route('users.index');
        }

        return redirect()->route('users.index');
    }
}
