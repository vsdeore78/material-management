<?php

namespace App\Http\Controllers;

use App\Models\MaterialTransaction;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialTransactionController extends Controller
{
    /**
     * Display all inward/outward transactions.
     */
    public function index()
    {
        $transactions = MaterialTransaction::with('material.category')
            ->orderByDesc('transaction_date')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the transaction creation form.
     */
    public function create()
    {
        $materials = Material::with('category')
            ->orderBy('name')
            ->get();

        return view('transactions.create', compact('materials'));
    }

    /**
     * Store a new inward/outward transaction.
     *
     * Positive quantity represents inward stock.
     * Negative quantity represents outward stock.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_id' => [
                'required',
                Rule::exists('materials', 'id')->whereNull('deleted_at'),
            ],
            'transaction_date' => 'required|date',
            'quantity' => 'required|numeric|decimal:0,2|not_in:0',
        ]);

        MaterialTransaction::create($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    /**
     * Not required by the assignment.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the transaction edit form.
     */
    public function edit(MaterialTransaction $transaction)
    {
        $materials = Material::with('category')
            ->orderBy('name')
            ->get();

        return view('transactions.edit', compact('transaction', 'materials'));
    }

    /**
     * Update an existing transaction.
     */
    public function update(
        Request $request,
        MaterialTransaction $transaction
    ) {
        $validated = $request->validate([
            'material_id' => [
                'required',
                Rule::exists('materials', 'id')->whereNull('deleted_at'),
            ],
            'transaction_date' => 'required|date',
            'quantity' => 'required|numeric|decimal:0,2|not_in:0',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    /**
     * Delete a transaction.
     */
    public function destroy(MaterialTransaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}