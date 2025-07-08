<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $sortOrder = $request->input('sort', 'desc'); // 'desc' for latest first, 'asc' for oldest first
        
        $query = Client::when($request->filled('search'), function ($query) use ($request) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
        ->orderBy('created_at', $sortOrder)
        ->orderBy('id', $sortOrder);
        
        if ($perPage === 'all') {
            $clients = $query->paginate(1000);
        } else {
            $clients = $query->paginate((int)$perPage);
        }
        
        if ($request->wantsJson()) {
            return response()->json($clients);
        }
        return view('clients.index', compact('clients', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'country' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('clients', 'public');
        }
        $client = Client::create($validated);
        if ($request->wantsJson()) {
            return response()->json($client, 201);
        }
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Client $client)
    {
        $client->load(['appointments', 'contracts', 'payments']);
        if ($request->wantsJson()) {
            return response()->json($client);
        }
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'country' => 'nullable|string|max:255',
        ]);
        // Handle image replacement
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($client->image) {
                Storage::disk('public')->delete($client->image);
            }
            $validated['image'] = $request->file('image')->store('clients', 'public');
        }
        $client->update($validated);
        if ($request->wantsJson()) {
            return response()->json($client);
        }
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Client deleted']);
        }
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    /**
     * Bulk delete clients.
     */
    public function bulkDelete(Request $request)
    {
        $ids = collect(explode(',', $request->input('ids')))->filter()->unique();
        if ($ids->isEmpty()) {
            return redirect()->route('clients.index')->with('error', 'لم يتم تحديد أي عناصر للحذف.');
        }
        $deleted = Client::whereIn('id', $ids)->delete();
        return redirect()->route('clients.index')->with('success', 'تم حذف العناصر المحددة بنجاح.');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $query = \App\Models\Client::query();
        if ($search) {
            $query->where('name', 'like', "%$search%");
        }
        $results = $query->select('id', 'name as text')->limit(20)->get();
        return response()->json(['results' => $results]);
    }
}
