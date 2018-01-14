<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
	public function show()
    {
        $restaurant = Auth::user();

		$categories = $restaurant->categories;

        return view('pages.admin.categories', [
			'restaurant' => $restaurant,
			'categories' => $categories
		]);
    }

	public function create(Request $request)
	{
		$restaurant = Auth::user();

		$this->validate($request, [
			'category-name' => 'required|min:1|string'
		]);

		$category = Category::create([
		    'name' => $request->get('category-name'),
			'restaurant_id' => $restaurant->id
		]);

		return redirect()->route('admin.categories.create')->with('message', 'La catégorie a été ajoutée');
	}

	public function destroy($id)
	{
		$restaurant = Auth::user();
		$category = Category::findOrFail($id);

		$products = $restaurant->products()->where('category_id', $category->id)->get();

		if (!$products->isEmpty()) {
			return redirect()->route('admin.categories.show')->with('error', 'Produit(s) existant(s) dans cette catégorie');
		}
		// dd($products);

		$category->delete();
		return redirect()->route('admin.categories.show')->with('message', 'La catégorie a été supprimée');
	}

	public function edit(Request $request)
	{
		$restaurant = Auth::user();

		$this->validate($request, [
			'categoryId' => 'required|string',
			'categoryName' => 'required|string'
		]);

		$category = Category::findOrFail($request->categoryId);
		$category->name = $request->categoryName;
		$category->save();

		return redirect()->route('admin.categories.show')->with('message', 'La catégorie a été modifiée');
	}
}
