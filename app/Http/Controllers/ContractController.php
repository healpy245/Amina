<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Client;
use App\Models\Dress;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $sortOrder = $request->input('sort', 'desc'); // 'desc' for latest first, 'asc' for oldest first
        
        $query = Contract::with(['client', 'dress'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhereHas('dress', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })
            ->orderBy('signed_at', $sortOrder)
            ->orderBy('id', $sortOrder);
            
        if ($perPage === 'all') {
            $contracts = $query->paginate(1000);
        } else {
            $contracts = $query->paginate((int)$perPage);
        }
        
        if ($request->wantsJson()) {
            return response()->json($contracts);
        }
        return view('contracts.index', compact('contracts', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $dresses = Dress::all();
        return view('contracts.create', compact('clients', 'dresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'client_id' => 'required|exists:clients,id',
            // 'dress_id' => 'required|exists:dresses,id', // removed, will be set from appointment
            'deposit_paid' => 'required|boolean',
            'signed_at' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);
        // Get dress_id from appointment, or set to null if dress_type is 'تصميم'
        $appointment = \App\Models\Appointment::findOrFail($validated['appointment_id']);
        if ($appointment->dress_type === 'جاهز') {
            $validated['dress_id'] = $appointment->dress_id;
        } else {
            $validated['dress_id'] = null;
        }
        // Set contract_number automatically before creation
        $nextId = (\App\Models\Contract::max('id') ?? 0) + 1;
        $validated['contract_number'] = '#' . $nextId;
        $contract = Contract::create($validated);
        if ($request->wantsJson()) {
            return response()->json($contract->load(['client', 'dress']), 201);
        }
        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Contract $contract)
    {
        $contract->load(['client', 'dress']);
        if ($request->wantsJson()) {
            return response()->json($contract);
        }
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        $clients = Client::all();
        $dresses = Dress::all();
        return view('contracts.edit', compact('contract', 'clients', 'dresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'dress_id' => 'required|exists:dresses,id',
            'deposit_paid' => 'required|boolean',
            'signed_at' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'deposit_amount' => 'nullable|numeric|min:0',
        ]);
        $contract->update($validated);
        // Handle deposit_amount
        if ($request->filled('deposit_amount')) {
            $deposit = $request->input('deposit_amount');
            $payment = $contract->payments()->whereNotNull('deposit')->first();
            if ($payment) {
                $payment->deposit = $deposit;
                $payment->save();
            } else {
                \App\Models\Payment::create([
                    'contract_id' => $contract->id,
                    'client_id' => $contract->client_id,
                    'amount' => 0,
                    'payment_number' => 'temp',
                    'status' => 'مكتمل',
                    'payment_method' => 'نقداً',
                    'paid_at' => now(),
                    'deposit' => $deposit,
                ]);
            }
        }
        if ($request->wantsJson()) {
            return response()->json($contract->load(['client', 'dress']));
        }
        return redirect()->route('contracts.index')->with('success', 'Contract updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Contract $contract)
    {
        $contract->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Contract deleted']);
        }
        return redirect()->route('contracts.index')->with('success', 'Contract deleted successfully.');
    }

    /**
     * Bulk delete contracts.
     */
    public function bulkDelete(Request $request)
    {
        $ids = collect(explode(',', $request->input('ids')))->filter()->unique();
        if ($ids->isEmpty()) {
            return redirect()->route('contracts.index')->with('error', 'لم يتم تحديد أي عناصر للحذف.');
        }
        $deleted = Contract::whereIn('id', $ids)->delete();
        return redirect()->route('contracts.index')->with('success', 'تم حذف العناصر المحددة بنجاح.');
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $query = \App\Models\Contract::with('client');
        if ($search) {
            $query->where('contract_number', 'like', "%$search%")
                  ->orWhereHas('client', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
        }
        $results = $query->limit(20)->get()->map(function($contract) {
            return [
                'id' => $contract->id,
                'text' => $contract->contract_number . ' - ' . ($contract->client->name ?? '')
            ];
        });
        return response()->json(['results' => $results]);
    }
}
