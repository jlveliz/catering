<?php

namespace Catering\Http\Controllers;

use Catering\Http\Requests\ProductRequest;
use Catering\Http\Resources\ProductResource;
use Catering\Models\Product;
use Illuminate\Http\Request;
use Exception;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Catering\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $product = new Product();
            $product->fill($request->all());
            $product->saveOrFail();
            DB::commit();
            return new ProductResource($product);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Hubo un error al ingresar el producto, intente nuevamente',
                'details' => $e->getMessage()],411);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return new ProductResource($product);
        }
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Catering\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $product = Product::find($id);

            if ($product) {
                $product->fill($request->all());
                $product->saveOrFail();
                DB::commit();
                return new ProductResource($product);
            }
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }catch(Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Hubo un error al actualizar el producto, intente nuevamente',
                'details' => $e->getMessage()
            ],411);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $productName =  $product->name;
            if($product->delete())
                return response()->json(['message' => "El producto {$productName} Eliminado  Correctamente"],200);
        }
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }
}
