<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->productService->index(auth()->user()->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->productService->storeProduct($request, auth()->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        return $this->productService->showProduct($slug, auth()->user()->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $slug
     * @return JsonResponse
     */
    public function update(Request $request, string $slug)
    {
        return $this->productService->updateProduct($request, $slug, auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function destroy($slug)
    {
        return $this->productService->deleteProduct($slug, auth()->user()->id);
    }
}
