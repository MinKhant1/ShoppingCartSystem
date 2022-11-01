<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    function index()
    {  
        
        return view('products');
      
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
