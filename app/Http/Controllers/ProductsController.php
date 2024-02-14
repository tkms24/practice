<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
//リクエストクラスを追加
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;

        // fillを使用する場合は、必ずモデルのfillableを指定する
        $product->fill($request->all())->save();
    
        // 一覧へ戻り完了メッセージを表示
        return redirect()->route('product.index')->with('message', '登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('product.edit' , ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->all())->save();

        return redirect()->route('product.index')->with('message','編集しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        product::where('id',$id)->delete();

        //完了メッセージ
        return redirect()->route('product.index')->with('message','削除しました');
    }
}
