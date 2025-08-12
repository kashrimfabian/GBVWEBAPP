<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    // Show list of categories
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
        ]);
    }

    // Show form to create a new category
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    // Store new category in database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show form to edit existing category
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function show(Category $category)
{
    return Inertia::render('Categories/Show', [
        'category' => $category,
    ]);
}


    // Update category in database
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->cat_id . ',cat_id|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category from database
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
