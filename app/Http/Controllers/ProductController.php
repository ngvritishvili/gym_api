<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->authorizeResource(Product::class, 'product');
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return response()->json([
                'products' => ProductResource::collection($this->productService->index()),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        try {
            return response()->json([
                'product' => ProductResource::make($this->productService->store($request)),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        try {
            return response()->json([
                ProductResource::make($this->productService->show($product)),
            ]);
        } catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->productService->update($request, $product);

            return response()->json([
                'message' => 'Successfully Updated'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->delete($product);
            return response()->json([
                'message' => 'Successfully Deleted'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
