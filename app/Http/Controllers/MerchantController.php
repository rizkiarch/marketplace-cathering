<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Merchant List";
        $merchants = Merchant::where('user_id', auth()->id())->get();
        return view('dashboard.merchants.index', [
            'title' => $title,
            'merchants' => $merchants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Merchant";
        return view('dashboard.merchants.create', [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        Merchant::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('merchant.index')->with('success', 'Merchant created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merchant $merchant)
    {
        $title = "Edit Merchant";

        if ($merchant->user_id !== auth()->id()) {
            abort(403);
        }
        return view('dashboard.merchants.edit', [
            'title' => $title,
            'merchant' => $merchant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merchant $merchant)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);
        dd($data);
        $merchant->update($data);
        return redirect()->route('profile.index')->with('success', 'Merchant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merchant $merchant)
    {
        if ($merchant->user_id !== auth()->id()) {
            abort(403);
        }

        $merchant->delete();
        return redirect()->route('merchant.index')->with('success', 'Merchant deleted successfully!');
    }
}
