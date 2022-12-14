<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    

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
                $quantity=$request->input('quantity');
              
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
                $quantity=$request->input('quantity');
              
             
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

    function edit_product_quantity(Request $request)
    {
        if($request->session()->has('cart'))
        {
            $product_id=$request->input('id');
            $product_quantity=$request->input('quantity');


            if($request->has('decrease_product_quantity_btn'))
            {
                $product_quantity--;

            }
            else if($request->has('increase_product_quantity_btn'))
            {

                $product_quantity++;
            }else
            {

            }


            if($product_quantity<=0)
            {
                $this->remove_from_Cart($request);
            }
            $cart=$request->session()->get('cart');

            if(array_key_exists($product_id,$cart))
            {
                $cart[$product_id]['quantity']=$product_quantity;
                $request->session()->put('cart',$cart);
                $this->calculateTotalCart($request);
            }

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

    function check_out()
    {
        $delivery_methods=DeliveryMethod::all();
        $payment_methods=PaymentMethod::all();
        return view('checkout')->with('payment_methods',$delivery_methods)->with('delivery_methods',$payment_methods);
    }

    function order_detail(Request $request)
    {


        $request->validate(
            [
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'city'=>'required',
            'address'=>'required',
            ]
        );

        $order=new Order();
        if(Auth::check())
        {
            $order->user_id=Auth::user()->id;

        }
        $order->user_name=$request->input('name');
        $order->email=$request->input('email');
        $order->address=$request->input('address');
        $order->city=$request->input('city');
        $order->phone=$request->input('phone');
        $order->total=session()->get('total');
        $order->delivery_method=$request->input('deliverymethod');
        $order->payment_method=$request->input('paymentmethod');
        $order->save();
        session()->put('order',$order);
       // session()->forget('cart');
       
        return view('order_detail')->with('order',$order);
       // $order->city=$request->input('city');
        // $order->






       
    }

    

    // public function index() {
    //     return view('order_detail');
    // }

    // public function exportpdf()
    // { 
    
     
    //     $order=session()->get('order');
    
    //     //dd($order);
    //     $pdf = Pdf::loadView('order_detail',['order'=>$order]); 
    //     // return $pdf->download ('file-pdf.pdf');
    //   $path = public_path('pdf_docs/'); 
    //   $fileName =  time().'.'. 'pdf' ; 
    //   $pdf->save($path . '/' . $fileName);
    //   $generated_pdf_link = url('pdf_docs/'.$fileName);
    //   return response()->json($generated_pdf_link);
    // }




}
