<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

    return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'nullable|unique:categories|max:255',
            'description' => 'nullable',
        ]);
    
        // If slug is not provided, generate it from the name
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']);
        }
    
        // Create the category
        $category = Category::create($validatedData);
    
        return redirect()->route('categories.show', $category)->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(10); //this is an example of model binding 

    return view('categories.show', compact('category', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable'
        ]);

        // If slug is not provided, generate it from the name
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']);
        }

        // Update the category
        $category->update($validatedData);

        return redirect()->route('categories.show', $category)->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('sucess', 'Category was removed' );
    }
}
