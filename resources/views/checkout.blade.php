@extends('layouts.main')

@section('content')
<div class="container-fluid pt-5">
    <div class="container">
    
   
<!-- Checkout -->
<section class="my-2 py-3 checkout">
    <div class="container text-center mt-1 pt-5">
        <h2>Check Out</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form id="checkout-form" action="{{route('order_detail')}}">
         
            @if (Auth::check())
            <div class="form-group checkout-small-element">
                <label for="">Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="name" value="{{auth()->user()->name}}" readonly>
            </div>

            <div class="form-group checkout-small-element">
                <label for="">Email</label>
                <input type="email" class="form-control" id="checkout-email" name="email" placeholder="email address" value="{{auth()->user()->email}}" readonly>
            </div>
            @else
            <div class="form-group checkout-small-element">
                <label for="">Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="name" value="">
            </div>

            <div class="form-group checkout-small-element">
                <label for="">Email</label>
                <input type="email" class="form-control" id="checkout-email" name="email" placeholder="email address" value="" >
            </div>
            @endif
           

            <div class="form-group checkout-small-element">
                <label for="">Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="phone number" required>
            </div>  

            <div class="form-group checkout-small-element">
                <label for="">City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="city" required>
            </div>

            <div class="form-group checkout-large-element">
                <label for="">Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="address" required>
            </div>

            <div class="col-2 form-group checkout-small-element">
                <label for="exampleFormControlSelect1">Select Delivery Method</label>
              <select class="form-control" id="deliverymethod"  name="deliverymethod" onchange="">
                {{-- <option value="">Select a Delivery Method</option> --}}
                @foreach ($delivery_methods as $delivery_method)
                <option value="{{$delivery_method->name}}">{{$delivery_method->name}}</option>
                @endforeach
              </select>
              </div>

              <div class="col-2 form-group checkout-small-element">
                <label for="exampleFormControlSelect1">Select Payment Method</label>
              <select class="form-control" id="paymentmethod"  name="paymentmethod" onchange="">
                {{-- <option value="">Select A Payment Method</option> --}}
                @foreach ($payment_methods as $payment_method)
                <option value="{{$payment_method->name}}">{{$payment_method->name}}</option>
                @endforeach
              </select>
              </div>


            <div class="form-group checkout-btn-container">
                @if(Session::has('total'))
        
                <p>Total amount: ${{Session::get('total')}}</p>
                <input type="submit" class="btn" id="checkout-btn" name="checkout_btn" value="Buy">
                @endif
            </div>
    
        </form>
    </div>
</section>

          
        
    </div>
</div>
@endsection