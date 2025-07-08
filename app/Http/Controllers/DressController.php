<?php

namespace App\Http\Controllers;

use App\Models\Dress;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        if ($perPage === 'all') {
            $dresses = Dress::with('category')->paginate(1000);
        } else {
            $dresses = Dress::with('category')->paginate((int)$perPage);
        }
        if ($request->wantsJson()) {
            return response()->json($dresses);
        }
        return view('dresses.index', compact('dresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dresses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:under_measurement,rented,returned,washing,available',
            'times_rented' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('dresses', 'public');
        }
        $dress = Dress::create($validated);
        if ($request->wantsJson()) {
            return response()->json($dress->load('category'), 201);
        }
        return redirect()->route('dresses.index')->with('success', 'Dress created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Dress $dress)
    {
        $dress->load('category');
        $contracts = $dress->contracts()->with('client')->get();
        $clients = $contracts->pluck('client')->unique('id');
        $rentedCount = $contracts->count();
        if ($request->wantsJson()) {
            return response()->json($dress);
        }
        return view('dresses.show', compact('dress', 'clients', 'rentedCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dress $dress)
    {
        $categories = Category::all();
        return view('dresses.edit', compact('dress', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dress $dress)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:under_measurement,rented,returned,washing,available',
            'times_rented' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
        ]);
        // Handle image replacement
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($dress->image) {
                Storage::disk('public')->delete($dress->image);
            }
            $validated['image'] = $request->file('image')->store('dresses', 'public');
        }
        $dress->update($validated);
        if ($request->wantsJson()) {
            return response()->json($dress->load('category'));
        }
        return redirect()->route('dresses.index')->with('success', 'Dress updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Dress $dress)
    {
        $dress->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Dress deleted']);
        }
        return redirect()->route('dresses.index')->with('success', 'Dress deleted successfully.');
    }

    /**
     * Bulk delete dresses.
     */
    public function bulkDelete(Request $request)
    {
        $ids = collect(explode(',', $request->input('ids')))->filter()->unique();
        if ($ids->isEmpty()) {
            return redirect()->route('dresses.index')->with('error', 'لم يتم تحديد أي عناصر للحذف.');
        }
        $deleted = Dress::whereIn('id', $ids)->delete();
        return redirect()->route('dresses.index')->with('success', 'تم حذف العناصر المحددة بنجاح.');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $results = \App\Models\Dress::where('name', 'like', "%$search%")
            ->select('id', 'name as text')
            ->limit(20)
            ->get();
        return response()->json(['results' => $results]);
    }
}
