<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProductRequest;
use App\Models\Frontend\Brand;
use App\Models\Frontend\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;


class ProductController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/ecommerce');
        } else {
            $userId = Auth::user()->id;
            $products = Product::where("id_user", $userId)->get()->toArray();
            return view('frontend.product.my_product', compact('products'));
        }
    }

    public function show()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(6);
        return view('frontend.home', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::find($id)->toArray();
        $images = json_decode($product['image'], true);
        // $images = $product['image'];
        return view('frontend.product.detail', compact('product', 'images'));
    }

    public function create()
    {
        $categories = Category::all()->toArray();
        $brands = Brand::all()->toArray();
        return view('frontend.product.add', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $files = [];
        $userId = Auth::user()->id;
        $makePath = "";
        if (!is_dir('upload/product/' . $userId . '/')) {
            $makePath = mkdir('upload/product/' . $userId . '/');
        }
        if (!Auth::check()) {
            return redirect('/ecommerce/login');
        } else {
            if ($request->hasfile('image')) {
                foreach ($request->file('image') as $file) {
                    $image = Image::read($file);

                    $name = $file->getClientOriginalName();
                    $name_2 = "hinh50_" . $file->getClientOriginalName();
                    $name_3 = "hinh200_" . $file->getClientOriginalName();

                    $path = public_path('upload/product/' . $userId . '/' . $name);
                    $path2 = public_path('upload/product/' . $userId . '/' . $name_2);
                    $path3 = public_path('upload/product/' . $userId . '/' . $name_3);

                    $image->save($path);
                    $image->resize(50, 70)->save($path2);
                    $image->resize(200, 300)->save($path3);

                    $files[] = $name;
                }
            }
            $data = $request->all();
            $data['image'] = $files;
            $data['id_user'] = $userId;

            $addProduct = Product::create($data);
            if ($addProduct) {
                return redirect('/ecommerce/my-product')->with('success', 'Successful!');
            }
        }
    }

    public function edit($id)
    {
        $categories = Category::all()->toArray();
        $brands = Brand::all()->toArray();
        $product = Product::where('id', $id)->first()->toArray();
        return view('frontend.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, $id)
    {
        $userId = Auth::user()->id;
        $product = Product::findOrFail($id);
        $data = $request->all();

        // Danh sách ảnh cũ
        $productImages = json_decode($product->image, true);

        // Lấy ảnh cần xoá và lưu vào mảng
        $imagesCheckbox = $request->imageCheckbox;

        if ($request->has('imageCheckbox')) {
            $deleteImages = $request->input('imageCheckbox');
            foreach ($deleteImages as $image) {
                if (isset($productImages[$image])) {
                    $path = public_path('upload/product/' . $userId . '/' . $productImages[$image]);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    unset($productImages[$image]);
                }
            }
            $productImages = array_values($productImages);
        }

        $newImages = [];
        $error = "";
        if ($request->hasfile('image')) {
            if (count($request->file('image')) > 3) {
               return response()->json(['Không được quá 3 hình!']);
            } else {
                foreach ($request->file('image') as $file) {
                    $image = Image::read($file);
                    $name = $file->getClientOriginalName();
                    $path = public_path('upload/product/' . $userId . '/' . $name);
                    $image->save($path);
                    $newImages[] = $name;
                }
                $data['image'] = $newImages;

                if ($product->update($data)) {
                    return redirect('/ecommerce/my-product')->with('success', 'Successful!');
                }
            }
        }
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Thành công');
    }
}
