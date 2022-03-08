<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products=  DB::table('products')->select('*')->get();
      return response()->json($products) ;//view('products.index',compact('products')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|min:3|max:50',
            'stock'=>'required',
            'brand' =>'required',
            'price' =>'required',
            'cost' =>'required',
            'desc'=>'required',
            'img'=>'required',
            'category_id'=>'required'
        ]);
        $nombre=$request->post('name');
        $stock=$request->post('stock');
        $marca=$request->post('brand');
        $precio=$request->post('price');
        $costo=$request->post('cost');
        $descripcion=$request->post('desc');
        $imagen=$request->post('img');
        $category_id=$request->post('category_id');
        DB::table('products')->insert([
            'name'=>$nombre,
            'stock'=>$stock,
            'brand'=> $marca,
            'price'=>$precio,
            'cost'=>$costo,
            'desc'=>$descripcion,
            'img'=>$imagen,
            'category_id'=>$category_id
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product=DB::table('products')->where('id',$id)->first();
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              $product=Product::findOrFail($id);
              $request->validate([
                'name'=>'required|min:3|max:50',
                'stock'=>'required',
                'brand' =>'required',
                'price' =>'required',
                'cost' =>'required',
                'desc'=>'required',
                'img'=>'required',
                'category_id'=>'required'
            ]);
              $product->name=$request->input('name');
              $product-> stock=$request->input('stock');
              $product->brand =$request->input('brand');
              $product->price=$request->input('price');
              $product-> cost =$request->input('cost');
              $product->desc=$request->input('desc');
              $product->img=$request->input('img');
              $product->category_id=$request->post('category_id');
              $product->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products')->where('id',$id)->delete();
    }
}
