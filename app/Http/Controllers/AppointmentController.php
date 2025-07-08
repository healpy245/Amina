<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Dress;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $sortOrder = $request->input('sort', 'desc'); // 'desc' for latest first, 'asc' for oldest first
        
        $query = Appointment::with('client')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhere('date', 'like', "%$search%");
            })
            ->orderBy('date', $sortOrder)
            ->orderBy('time', $sortOrder)
            ->orderBy('id', $sortOrder);
            
        if ($perPage === 'all') {
            $appointments = $query->paginate(1000);
        } else {
            $appointments = $query->paginate((int)$perPage);
        }
        
        if ($request->wantsJson()) {
            return response()->json($appointments);
        }
        return view('appointments.index', compact('appointments', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $dresses = Dress::all();
        $types = ['عروس', 'سهرة'];
        $dressTypes = ['تصميم', 'جاهز'];
        return view('appointments.create', compact('clients', 'dresses', 'types', 'dressTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'dress_id' => 'required_if:dress_type,جاهز|nullable|exists:dresses,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
            'type' => 'required|in:عروس,سهرة',
            'dress_type' => 'required|in:تصميم,جاهز',
        ]);
        $appointment = Appointment::create($validated);
        if ($request->wantsJson()) {
            return response()->json($appointment->load('client'), 201);
        }
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Appointment $appointment)
    {
        $appointment->load('client');
        if ($request->wantsJson()) {
            return response()->json($appointment);
        }
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $dresses = Dress::all();
        $types = ['عروس', 'سهرة'];
        $dressTypes = ['تصميم', 'جاهز'];
        return view('appointments.edit', compact('appointment', 'clients', 'dresses', 'types', 'dressTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'dress_id' => 'required|exists:dresses,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
            'type' => 'required|in:عروس,سهرة',
            'dress_type' => 'required|in:تصميم,جاهز',
        ]);
        $appointment->update($validated);
        if ($request->wantsJson()) {
            return response()->json($appointment->load('client'));
        }
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Appointment $appointment)
    {
        $appointment->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Appointment deleted']);
        }
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    /**
     * Bulk delete appointments.
     */
    public function bulkDelete(Request $request)
    {
        $ids = collect(explode(',', $request->input('ids')))->filter()->unique();
        if ($ids->isEmpty()) {
            return redirect()->route('appointments.index')->with('error', 'لم يتم تحديد أي عناصر للحذف.');
        }
        $deleted = Appointment::whereIn('id', $ids)->delete();
        return redirect()->route('appointments.index')->with('success', 'تم حذف العناصر المحددة بنجاح.');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $query = \App\Models\Appointment::query();
        if ($search) {
            $query->where('id', 'like', "%$search%");
        }
        $results = $query->select('id')->limit(20)->get()->map(function($appointment) {
            return [
                'id' => $appointment->id,
                'text' => '#' . $appointment->id
            ];
        });
        return response()->json(['results' => $results]);
    }
}
