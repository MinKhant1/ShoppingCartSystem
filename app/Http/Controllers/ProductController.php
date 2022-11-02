<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    // function index()
    // {  
        
    //     return view('products');
      
    // }


    function products()
    {
        $products=Product::all();

        return view('products')->with('products',$products);
    
    }


    function single_product($id)
    {

        $product=Product::find($id);

        return view('single_product')->with('product',$product);
    }

    function productlist()
    {
        if(auth()->user()->role==1)
        { 
            $products=Product::all();
            return view('admin.productlist')->with('products',$products);

        }
       
    }

    function addproduct()
    {
    
        if(auth()->user()->role==1)
        {  return view('admin.addproduct');
        }
    }

    function deleteproduct($id)
    {
        $product=Product::find($id);
        $product->delete();

        return back()->with('status', 'Product has been deleted!');

    }

    function editproduct($id)
    { 
        $product=Product::find($id);

        //dd($product->description);
        return view('admin.editproduct')->with('product',$product);
    }
    

    function updateproduct(Request $request)
    {
        $product=Product::find($request->input('id'));
       
          $products=Product::all();
        $request->validate(
            [
            'product_name'=>'required',
            'product_price'=>'required',
            'product_quantity'=>'required',
            'product_category'=>'required',
            'product_image'=>'required',
            ]
        );

  if($request->hasFile('product_image'))
        {
            $destination_path='public/images/products';
            $image=$request->file('product_image');
            $image_name=$image->getClientOriginalName();
            $path=$request->file('product_image')->storeAs($destination_path,$image_name);
            
        }
        $product->image=$image_name;
        $product->name=$request->input('product_name');
        $product->quantity=$request->input('product_quantity');
        $product->price=$request->input('product_price');
        $product->description=$request->input('product_description');
        $product->category=$request->input('product_category');


        $product->update();

        return view('admin.productlist')->with('status', 'Product has been updated!')->with('products',$products);
        

    }

    function saveproduct(Request $request)
    {

         $product=new Product();
       

        $request->validate(
            [
            'product_name'=>'required',
            'product_price'=>'required',
            'product_quantity'=>'required',
            'product_category'=>'required',
            'product_image'=>'required',
          
            ]
        );

        if($request->hasFile('product_image'))
        {
            $destination_path='public/images/products';
            $image=$request->file('product_image');
            $image_name=$image->getClientOriginalName();
            $path=$request->file('product_image')->storeAs($destination_path,$image_name);
            
        }
        $product->image=$image_name;
        $product->name=$request->input('product_name');
        $product->quantity=$request->input('product_quantity');
        $product->price=$request->input('product_price');
        $product->description=$request->input('product_description');
        $product->category=$request->input('product_category');

        $product->save();
        return back()->with('status', 'Product has been added!');




    }



}
