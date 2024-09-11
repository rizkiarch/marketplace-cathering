<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Traits\WhatsappTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    use WhatsappTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('dashboard.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = $request->input('search');

        $products = Product::whereHas('merchant', function ($query) use ($search) {
            if ($search) {
                $query->where('type', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%");
            }
        })->get();
        return view('dashboard.orders.create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_date' => 'required|date',
            'total_porsi' => 'required|integer|min:1',
            'pickup_date' => 'required|date',
            'total_price' => 'required|integer|min:0',
            'product_id' => 'required|exists:products,id',
            'phone' => 'required|string',
        ]);

        $data['order_date'] = Carbon::parse($data['order_date']);
        $data['pickup_date'] = Carbon::parse($data['pickup_date']);

        $product = Product::find($data['product_id']);
        $order = Order::create([
            'order_date' => $request->input('order_date'),
            'total_porsi' => $request->input('total_porsi'),
            'pickup_date' => $request->input('pickup_date'),
            'total_price' => $request->input('total_price'),
            'product_id' => $request->input('product_id'),
            'user_id' => Auth::id(),
        ]);

        $this->invoice($order);

        $message = "Hello, your order for *" . $product->name . "* has been placed successfully. Total Price: *" . number_format($order->total_price, 0, ',', '.') . " IDR.* Thank you! Your order is being processed.";
        $result = $this->sendTextWatsapp($data['phone'], $message);


        return redirect()->route('order.index')->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {

        $request->validate([
            'order_date' => 'required|date',
            'total_porsi' => 'required|integer|min:1',
            'pickup_date' => 'required|date',
            'total_price' => 'required|integer|min:0',
            'product_id' => 'required|exists:products,id',
        ]);

        $order->update([
            'order_date' => $request->input('order_date'),
            'total_porsi' => $request->input('total_porsi'),
            'pickup_date' => $request->input('pickup_date'),
            'total_price' => $request->input('total_price'),
            'product_id' => $request->input('product_id'),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function invoice($order)
    {
        $invoice = $order->invoice()->create([
            'order_id' => $order->id,
            'invoice_date' => now(),
            'total_price' => $order->total_price,
            'is_paid' => false,
        ]);

        return redirect()->route('invoice.show', $invoice)->with('success', 'Invoice created successfully.');
    }
}
