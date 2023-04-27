<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ProductRequest;
use App\Models\Shop\Product;
use App\Services\Message\Message;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Shop/Product/Index', [
            'products' => Product::orderBy('title')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Shop/Product/Create');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Shop/Product/Edit', [
            'product' => $product,
        ]);
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        Message::show('Продукт создан');

        return redirect()->route('product.index');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        Message::success('Продукт изменён');

        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        Message::show('Продукт удалён');

        return redirect()->route('product.index');
    }
}
