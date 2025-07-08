<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Client;
use App\Models\Contract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $sortOrder = $request->input('sort', 'desc'); // 'desc' for latest first, 'asc' for oldest first
        
        $query = Payment::with(['client', 'contract'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhereHas('contract', function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%");
                });
            })
            ->orderBy('paid_at', $sortOrder)
            ->orderBy('id', $sortOrder);
            
        if ($perPage === 'all') {
            $payments = $query->paginate(1000);
        } else {
            $payments = $query->paginate((int)$perPage);
        }
        
        if ($request->wantsJson()) {
            return response()->json($payments);
        }
        return view('payments.index', compact('payments', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $contracts = Contract::all();
        return view('payments.create', compact('clients', 'contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
            'paid_at' => 'required|date',
            'status' => 'required',
        ]);
        $contract = Contract::findOrFail($validated['contract_id']);
        $validated['client_id'] = $contract->client_id;
        // Temporarily set payment_number to a placeholder, will update after creation
        $validated['payment_number'] = 'temp';
        $payment = Payment::create($validated);
        $payment->payment_number = '#' . $payment->id;
        $payment->save();
            $contract->update(['deposit_paid' => true]);
        if ($request->wantsJson()) {
            return response()->json($payment->load(['client', 'contract']), 201);
        }
        return redirect()->route('payments.index')->with('success', 'تم إنشاء المدفوعات بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Payment $payment)
    {
        $payment->load(['client', 'contract']);
        if ($request->wantsJson()) {
            return response()->json($payment);
        }
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $clients = Client::all();
        $contracts = Contract::all();
        return view('payments.edit', compact('payment', 'clients', 'contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'contract_id' => 'required|exists:contracts,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,credit_card,bank_transfer',
            'paid_at' => 'required|date',
            'deposit' => 'nullable|numeric|min:0',
        ]);
        
        // Update the payment
        $payment->update($validated);
        
        // Update the contract's deposit_paid status to true
        $contract = Contract::find($validated['contract_id']);
        if ($contract) {
            $contract->update(['deposit_paid' => true]);
        }
        
        if ($request->wantsJson()) {
            return response()->json($payment->load(['client', 'contract']));
        }
        return redirect()->route('payments.index')->with('success', 'تم تحديث المدفوعات بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Payment $payment)
    {
        $payment->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Payment deleted']);
        }
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    /**
     * Bulk delete payments.
     */
    public function bulkDelete(Request $request)
    {
        $ids = collect(explode(',', $request->input('ids')))->filter()->unique();
        if ($ids->isEmpty()) {
            return redirect()->route('payments.index')->with('error', 'لم يتم تحديد أي عناصر للحذف.');
        }
        $deleted = Payment::whereIn('id', $ids)->delete();
        return redirect()->route('payments.index')->with('success', 'تم حذف العناصر المحددة بنجاح.');
    }
}
