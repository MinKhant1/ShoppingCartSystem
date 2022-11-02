@extends('layouts.main')

@section('content')

 <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Products</h6>
                <h1 class="display-5 text-uppercase mb-0">Products For Your Best Friends</h1>
            </div>
            <div class="row">

                @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                        <img style="width:200px; height: 200px" class="img-fluid mb-4 mx-auto" src="{{asset('/storage/images/products/'.$product->image)}}" alt="">
                        <h6 class="text-uppercase">{{$product->name}}</h6>
                        <h5 class="text-primary mb-0">${{$product->price}}</h5>
                        <div class="btn-action d-flex justify-content-center">

                            <form action= "{{route('add_to_cart')}}" method="POST">
                                @csrf
                                  <input type="hidden" name="id" value="{{$product->id}}">
                                  <input type="hidden" name="product_name" value="{{$product->name}}">
                                  <input type="hidden" name="product_image" value="{{$product->image}}">
                                  <input type="hidden" name="product_price" value="{{$product->price}}">
                                  <input type="hidden" name="quantity" value="1">
                                  <button type="submit" style="background: none; border:none">
                            <a class="btn btn-primary py-2 px-3" ><i class="bi bi-cart"></i></a>
                                  </button>
                            </form>
                            <a class="btn btn-primary py-2 px-3" href="{{url('/single_product/'.$product->id)}}"><i class="bi bi-eye"></i></a>
                        
                        </div>
                    </div>
                </div>
                @endforeach

                 



    {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                        <img style="width:200px; height: 200px" class="img-fluid mb-4 mx-auto" src="img/product-1.png" alt="">
                        <h6 class="text-uppercase">Quality Pet Foods</h6>
                        <h5 class="text-primary mb-0">$199.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>



    <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                        <img style="width:200px; height: 200px" class="img-fluid mb-4 mx-auto" src="img/product-1.png" alt="">
                        <h6 class="text-uppercase">Quality Pet Foods</h6>
                        <h5 class="text-primary mb-0">$199.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>





                
    <div class="col-lg-3 col-md-6 col-sm-12"> --}}
                    {{-- <div class="product-item position-relative bg-light d-flex flex-column text-center">
                        <img style="width:200px; height: 200px" class="img-fluid mb-4 mx-auto" src="img/product-1.png" alt="">
                        <h6 class="text-uppercase">Quality Pet Foods</h6>
                        <h5 class="text-primary mb-0">$199.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div> --}}


            
            </div>
        </div>
        
    </div>


@endsection