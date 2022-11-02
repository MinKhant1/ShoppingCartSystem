@extends('layouts.main')

@section('content')
<div class="container-fluid pt-5">
    <div class="container">
    
         

<section class="cart container mt-2 my-3 py-5">
    <div class="container mt-2">
        <h4>Your Cart</h4>
    </div>

    <table class="pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>     
        @if(Session::has('cart'))
        @foreach(Session::get('cart') as $product)
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="{{asset('/storage/images/products/'.$product['image'])}}">
                            <div>
                                <p>{{$product['name']}}</p>
                                <small><span>$</span>{{$product['price']}}</small>
                                <br>
                                <form action="{{route('remove_from_cart')}}" method="POST"> 
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product['id']}}">
                                    <input type="submit" name="remove_btn" class="remove-btn" value="remove">
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <form>
                            <input type="number" name="quantity" value="1">
                            <input type="submit" value="edit" class="edit-btn" name="edit_product_quantity_btn">
                        </form>
                    </td>

                    <td>
                        <span class="product-price">$199</span>
                    </td>
                </tr>
                @endforeach
                @endif
       

    </table>


    <div class="cart-total">
        <table>
  
            <tr>
                <td>Total</td>
                <td>$199</td>
            </tr>
       
        </table>
    </div>
    

    <div class="checkout-container">
   
        <form >
            <input type="submit" class="btn checkout-btn" value="Checkout" name="">
        </form>
      
    
    </div>





</section>

          
    
    </div>
</div>
@endsection