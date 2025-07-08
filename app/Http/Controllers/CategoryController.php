<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        if ($perPage === 'all') {
            $categories = Category::paginate(1000); // Large number to show all
        } else {
            $categories = Category::paginate((int)$perPage);
        }
        if ($request->wantsJson()) {
            return response()->json($categories);
        }
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
        $category = Category::create($validated);
        if ($request->wantsJson()) {
            return response()->json($category, 201);
        }
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Category $category)
    {
        if ($request->wantsJson()) {
            return response()->json($category);
        }
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        // Handle image replacement
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
        $category->update($validated);
        if ($request->wantsJson()) {
            return response()->json($category);
        }
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Category deleted']);
        }
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * Bulk delete categories.
     */
    public function bulkDelete(Request $request)
    {
        $ids = collect(explode(',', $request->input('ids')))->filter()->unique();
        if ($ids->isEmpty()) {
            return redirect()->route('categories.index')->with('error', 'لم يتم تحديد أي عناصر للحذف.');
        }
        $deleted = Category::whereIn('id', $ids)->delete();
        return redirect()->route('categories.index')->with('success', 'تم حذف العناصر المحددة بنجاح.');
    }
}
