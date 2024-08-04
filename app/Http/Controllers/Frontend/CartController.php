<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return view('frontend.cart.cart', compact('cart', 'totalPrice'));
    }

    public function add(Request $request)
    {
        //Lấy product id
        $userId = Auth::user()->id;
        $productId = $request->product_id;
        $quantity = $request->product_quantity;
        $product = Product::where('id', $productId)->first()->toArray();
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'user_id' => $userId,
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $quantity
            ];
        }
        session()->put('cart', $cart);
        return redirect('ecommerce/cart');
        // dd($userId);
    }

    public function update(Request $request)
    {
        $total = 1;
        if ($request->ajax()) {
            $cart = session()->get('cart', []);
            $productId = $request->id;
            $quantity = $request->quantity;

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }

            return response()->json(['message' => 'Cart updated successfully', 'total']);
        }
    }

    public function removeCartItem(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        $total = $this->getTotalCart();

        return response()->json(['status' => 'success', 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng', 'total' => $total]);
    }


    private function getTotalCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }


    public function clearCart(Request $request)
    {
        session()->forget('cart');
        return redirect('ecommerce');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $user = Auth::user();
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return view('frontend.cart.checkout', compact('cart', 'totalPrice', 'user'));
    }
}
