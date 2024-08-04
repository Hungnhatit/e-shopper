<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Brand;
use App\Models\Frontend\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $cates = Category::all()->toArray();
        $brands = Brand::all()->toArray();
        $searchInput = $request->search_input;
        $productsResult = Product::where("name", "like", "%" . $searchInput . "%");
        $products = $productsResult->get()->toArray();
        $productsCount = $productsResult->get()->count();
        return view('frontend.search.index', compact('products', 'productsCount', 'cates', 'brands'));
    }

    public function searchAdvance(Request $request)
    {
        $cates = Category::all()->toArray();
        $brands = Brand::all()->toArray();

        $name = $request->name;
        $price = $request->price;
        $brand = $request->brand;
        $cate = $request->category;
        $status = $request->status;
        $prices = explode('-', $price);

        $searchResult = Product::query();
        if ($name != null) {
            $searchResult = Product::where("name", "like", "%" . $name . "%");
        }

        if ($price != null) {
            if ($price == '0-1000' || $price == '1000-2000') {
                $searchResult->whereBetween("price", [(int)$prices[0], (int)$prices[1]]);
            }
        }

        if ($brand != null) {
            $searchResult->where("id_brand", $brand);
        }
        if ($cate != null) {
            $searchResult->where("id_category", $cate);
        }
        if ($status != null) {
            $searchResult->where("status", $status);
        }

        $products = $searchResult->get()->toArray();
        $productsCount = $searchResult->get()->count();

        return view('frontend.search.index', compact('products', 'cates', 'brands', 'productsCount'));
    }

    public function fetchProduct(Request $request)
    {
        $cates = Category::all()->toArray();
        $brands = Brand::all()->toArray();
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');

        $searchResult = Product::whereBetween('price', [(int)$minPrice, (int)$maxPrice]);
        $products = $searchResult->get()->toArray();
        $productsCount = $searchResult->get()->count();        
        return response()->json(['products' => $products]);
    }
}
