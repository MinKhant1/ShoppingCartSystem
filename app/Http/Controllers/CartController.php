<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //


    function cart()
    {
        return view('cart');
    }

    function add_to_cart(Request $request)
    {
        if(session()->has('cart'))
        {
            $cart=session()->get('cart');
            $products_array_ids=array_column($cart,'id');

            $id=$request->input('id');

            if(!in_array($id,$products_array_ids))
            {
                $name=$request->input('product_name');
                $price=$request->input('product_price');
                $image=$request->input('product_image');
                $quantity=$request->input('product_quantity');
                // $sale_price=$request->input('sale_price');

                $product_array=array(
                            'id'=>$id,
                            'name'=>$name,
                            'image'=>$image,
                            'price'=>$price,
                            'quantity'=>$quantity
                );
               
                $cart[$id]=$product_array;
                session()->put('cart',$cart);
               
 
            }
            else
            {
                echo "<script>alert('product is already in the cart');</script>";
            }

            $this->calculateTotalCart($request);
            return view('cart');

        }
        else
        { 
                $cart=array();
                $id=$request->input('id');
                $name=$request->input('product_name');
                $price=$request->input('product_price');
                $image=$request->input('product_image');
                $quantity=$request->input('product_quantity');
             
                $product_array=array(
                            'id'=>$id,
                            'name'=>$name,
                            'image'=>$image,
                            'price'=>$price,
                            'quantity'=>$quantity
                );

             

                $cart[$id]=$product_array;

                session()->put('cart',$cart);
               
                $this->calculateTotalCart($request);
                return view('cart');
        }

    }

    function remove_from_Cart(Request $request)
    {
        
      if($request->session()->has('cart')) 
      {
        $id=$request->input('id');
        $cart=$request->session()->get('cart');

        unset($cart[$id]);

        $request->session()->put('cart',$cart);

        $this->calculateTotalCart($request);
        return view('cart');

      }
    }


    function calculateTotalCart(Request $request)
    {
        $cart=$request->session()->get('cart');
        $total_price=0;
        $total_quantity=0;

        foreach($cart as $id=>$product)
        {
            $product=$cart[$id];
            $price=$product['price'];
            $quantity=$product['quantity'];
        
            $total_price=$total_price+($price*$quantity);
            $total_quantity=$total_quantity+$quantity;

        }

        $request->session()->put('total',$total_price);
        $request->session()->put('quantity',$total_quantity);

    }
}
