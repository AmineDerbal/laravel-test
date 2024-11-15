<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Contracts\Cache\Store;

class ProductController extends Controller
{
    public function index()
    {
        $filePath = storage_path('products.json');

        // check if the file exists if not create it
        if (!file_exists($filePath)) {

            file_put_contents($filePath, json_encode([]));
        }
        $products = json_decode(file_get_contents(storage_path('products.json')), true);
        $totalPrice = array_sum(array_map(function ($product) {
            return $product['price'] * $product['quantity'];
        }, $products));

        return view('products.index', compact('products', 'totalPrice'));
    }

    public function store(StoreProductRequest $request)
    {
        // Store the product in json file
        $data = $request->validated();
        $data['date_created'] = now()->toDateTimeString();
        $products = json_decode(file_get_contents(storage_path('products.json')), true);

        $products[] = $data;
        file_put_contents(storage_path('products.json'), json_encode($products));
        // total price of all products price * quantity
        $totalPrice = array_sum(array_map(function ($product) {
            return $product['price'] * $product['quantity'];
        }, $products));

        return redirect()->route('products.index', compact('products', 'totalPrice'));

    }
}
