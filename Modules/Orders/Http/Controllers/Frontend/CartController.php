<?php

namespace Modules\Orders\Http\Controllers\Frontend;

use Modules\Products\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getCart()
    {
        return view('frontend.pages.cart');
    }

    public function addToCart(Request $request, $id)
    {
        $product = $this->productRepository->findProductById($id);
        $options = $request->except('_token', 'price', 'qty');
        \Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }

    public function removeItem($id)
    {
        \Cart::remove($id);

        if (\Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }

    public function clearCart()
    {
        \Cart::clear();

        return redirect('/');
    }
}
