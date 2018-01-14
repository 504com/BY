<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
	public function show()
    {
        $restaurant = Auth::user();
		$categories = $restaurant->categories;
		$products = $restaurant->products()->with('category')->get();

        return view('pages.admin.products', [
			'restaurant' => $restaurant,
			'products' => $products,
			'categories' => $categories
		]);
    }

	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		$orders = Order::with('products')->get();


		if (!$product->orders->isEmpty()) {
			return redirect()->route('admin.products.show')->with('error', 'Produit existant dans une commande');
		}

		$product->delete();

		return redirect()->route('admin.products.show')->with('message', 'La produit a été supprimé');
	}

	public function create(Request $request)
	{
		$restaurant = Auth::user();

		$this->validate($request, [
			'product-name' => 'required|string',
			'product-description' => 'required|string',
			'product-price' => 'required|numeric',
			'product-category' => 'required|string'
		]);

		$product = Product::create([
		    'name' => $request->get('product-name'),
		    'description' => $request->get('product-description'),
		    'price' => $request->get('product-price'),
		    'category_id' => $request->get('product-category')
		]);

		return redirect()->route('admin.products.create')->with('message', 'Le produit a été ajouté');
	}

	public function edit(Request $request)
	{
		$restaurant = Auth::user();

		$this->validate($request, [
			'edit-product' => 'required|numeric',
			'edit-product-name' => 'required|string',
			'edit-product-description' => 'required|string',
			'edit-product-price' => 'required|numeric',
			'edit-product-category' => 'required|numeric'
		]);

		$product = Product::findOrFail($request->get('edit-product'));
		$product->name = $request->get('edit-product-name');
		$product->description = $request->get('edit-product-description');
		$product->price = $request->get('edit-product-price');
		$product->save();

		return redirect()->route('admin.products.show')->with('message', 'Le produit a été modifié');
	}

}
