<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::with('category')
            ->withSum('transactions', 'quantity')
            ->get();

        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('materials.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'opening_balance' => 'required|numeric|min:0|decimal:0,2',
        ]);

        Material::create($validated);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $categories = Category::orderBy('name')->get();

        return view('materials.edit', compact('material', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'opening_balance' => 'required|numeric|min:0|decimal:0,2',
        ]);

        $material->update($validated);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Material $material)
    {
        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}