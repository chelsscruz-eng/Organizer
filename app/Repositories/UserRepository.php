<?php

namespace App\Repositories;

use App\Models\User;
use Exception;

class UserRepository
{
    public function getAll()
    {
        return User::orderBy('name')->get();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function create($data)
    {
        try {
            return User::create($data);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return null;
            }

            $user->update($data);

            return $user;
        } catch (Exception $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return null;
            }

            $user->delete();

            return $user;
        } catch (Exception $e) {
            return null;
        }
    }
}