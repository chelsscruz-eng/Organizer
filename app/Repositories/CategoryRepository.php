<?php

namespace App\Repositories;

use App\Models\Category;
use Exception;

class CategoryRepository
{
    public function getAll()
    {
        return Category::orderBy('name')->get();
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function create($data)
    {
        try {
            return Category::create($data);
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return null;
            }

            $category->update($data);

            return $category;
        } catch (Exception $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return null;
            }

            $category->delete();

            return $category;
        } catch (Exception $e) {
            return null;
        }
    }
}