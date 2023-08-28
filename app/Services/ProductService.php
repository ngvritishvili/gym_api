<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Country;
use App\Models\Product;

class ProductService
{
    public function index()
    {
        return Product::with('owner')->get();
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function create()
    {
        return Country::select('name')->get();
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('images'))
        {
            $product->addMediaFromRequest('images')
                ->toMediaCollection();
        }

        auth()->user()->products()->save($product);

        return $product;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->hasFile('images'))
        {
            $product->syncFromMediaLibraryRequest($request->images)
                ->toMediaCollection();
        }

        return $product;
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }

}
