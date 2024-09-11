<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Product;
use App\Traits\WhatsappTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    use WhatsappTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        if ($user->role === 'merchant') {
            $merchantIds = Merchant::where('user_id', $user->id)->pluck('id');

            $invoices = Invoice::whereHas('order', function ($query) use ($merchantIds) {
                $query->whereIn('product_id', function ($subQuery) use ($merchantIds) {
                    $subQuery->select('id')
                        ->from('products')
                        ->whereIn('merchant_id', $merchantIds);
                });
            })->get();
        } else {
            $invoices = Invoice::with('order.product')->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();
        }

        return view('dashboard.invoices.index', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $merchantIds = Merchant::where('user_id', $user->id)->pluck('id');

        $invoices = Invoice::whereHas('order', function ($query) use ($merchantIds) {
            $query->whereIn('product_id', function ($subQuery) use ($merchantIds) {
                $subQuery->select('id')
                    ->from('products')
                    ->whereIn('merchant_id', $merchantIds);
            });
        })->get();
        return view('dashboard.invoices.create', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'invoice_date' => 'required|date',
            'total_price' => 'required|integer|min:0',
            'is_paid' => 'boolean',
        ]);

        Invoice::create($data);

        return redirect()->route('invoice.index')->with('status', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // dd($invoice);
        return view('dashboard.invoices.show', [
            'invoice' => $invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $orders = Order::all();
        return view('dashboard.invoices.edit', [
            'invoice' => $invoice,
            'orders' => $orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'invoice_date' => 'required|date',
            'total_price' => 'required|integer|min:0',
            'is_paid' => 'required|boolean',
            'phone' => 'required|string',
        ]);

        $invoice->update([
            'order_id' => $data['order_id'],
            'invoice_date' => $data['invoice_date'],
            'total_price' => $data['total_price'],
            'is_paid' => $data['is_paid'],
        ]);

        $order = Order::find($data['order_id']);
        $message = "Your invoice for the product *" . $order->product->name . "* has been updated. Please check your account for details.";
        $result = $this->sendTextWatsapp($data['phone'], $message);

        return redirect()->route('invoice.index')->with('status', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('status', 'Invoice deleted successfully.');
    }
}
