<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DummyProduct;
use App\Models\User;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index()
    {
        $user = Auth::user();

        // Get cart items with product details
        $cartItems = $user->carts()
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get user addresses
        $addresses = $user->addresses()
            ->orderBy('is_default', 'desc')
            ->get();

        // Calculate cart total
        $subtotal = $cartItems->sum('subtotal');
        $shippingCost = 10000; // Default shipping cost
        $total = $subtotal + $shippingCost;

        return view('consumer.cart.index', compact('cartItems', 'addresses', 'subtotal', 'shippingCost', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, $productId)
    {
        try {
            $user = Auth::user();
            $product = DummyProduct::findOrFail($productId);

            // Check if product is available
            if (!$product->isInStock()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak tersedia atau stok habis'
                ], 400);
            }

            // Check if product already in cart
            $existingCartItem = $user->carts()
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                // Update quantity if already in cart
                $newQuantity = $existingCartItem->quantity + 1;

                // Check if stock is sufficient
                if ($newQuantity > $product->stok) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi'
                    ], 400);
                }

                $existingCartItem->quantity = $newQuantity;
                $existingCartItem->calculateSubtotal();
                $existingCartItem->save();

                $message = 'Jumlah produk di keranjang diperbarui';
            } else {
                // Add new item to cart
                $cartItem = new Cart();
                $cartItem->user_id = $user->id;
                $cartItem->product_id = $productId;
                $cartItem->quantity = 1;
                $cartItem->price = $product->harga;
                $cartItem->calculateSubtotal();
                $cartItem->save();

                $message = 'Produk berhasil ditambahkan ke keranjang';
            }

            // Get cart count
            $cartCount = $user->carts()->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            $user = Auth::user();
            $cartItem = $user->carts()->findOrFail($validated['id']);
            $product = $cartItem->product;

            // Check if stock is sufficient
            if ($validated['quantity'] > $product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi'
                ], 400);
            }

            // Update cart item
            $cartItem->quantity = $validated['quantity'];
            $cartItem->calculateSubtotal();
            $cartItem->save();

            // Calculate new subtotal
            $subtotal = $cartItem->getFormattedSubtotalAttribute();

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui',
                'subtotal' => $subtotal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        try {
            $user = Auth::user();
            $cartItem = $user->carts()->findOrFail($id);
            $cartItem->delete();

            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus produk dari keranjang');
        }
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        try {
            $user = Auth::user();
            $user->carts()->delete();

            return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengosongkan keranjang');
        }
    }

    /**
     * Process checkout.
     */
    public function checkout(Request $request)
    {
        try {
            $validated = $request->validate([
                'address_id' => 'required|exists:addresses,id',
                'payment_method' => 'required|string',
                'notes' => 'nullable|string'
            ]);

            $user = Auth::user();
            $cartItems = $user->carts()->with('product')->get();

            // Check if cart is empty
            if ($cartItems->isEmpty()) {
                return redirect()->route('konsumen.cart.index')
                    ->with('error', 'Keranjang belanja Anda kosong');
            }

            // Verify address belongs to user
            $address = $user->addresses()->findOrFail($validated['address_id']);

            // Begin transaction
            DB::beginTransaction();

            try {
                // Calculate order totals
                $subtotal = $cartItems->sum('subtotal');
                $shippingCost = 10000; // Default shipping cost
                $totalAmount = $subtotal + $shippingCost;

                // Create order
                $order = new Order();
                $order->user_id = $user->id;
                $order->address_id = $validated['address_id'];
                $order->order_number = $this->generateOrderNumber();
                $order->subtotal = $subtotal;
                $order->shipping_cost = $shippingCost;
                $order->total_amount = $totalAmount;
                $order->status = 'Pending';
                $order->payment_status = 'Unpaid';
                $order->payment_method = $validated['payment_method'];
                $order->notes = $validated['notes'] ?? null;
                $order->save();

                // Create order items
                foreach ($cartItems as $cartItem) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $cartItem->product_id;
                    $orderItem->price = $cartItem->price;
                    $orderItem->quantity = $cartItem->quantity;
                    $orderItem->subtotal = $cartItem->subtotal;
                    $orderItem->save();

                    // Update product stock
                    $product = $cartItem->product;
                    $product->stok -= $cartItem->quantity;
                    $product->save();
                }

                // Clear cart
                $user->carts()->delete();

                DB::commit();

                return redirect()->route('konsumen.purchase.detail', $order->id)
                    ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return redirect()->route('konsumen.cart.index')
                ->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique order number.
     */
    private function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Get cart count.
     */
    public function count()
    {
        $user = Auth::user();
        $count = $user->carts()->count();

        return response()->json([
            'count' => $count
        ]);
    }
}
