
@extends('layouts.main')

@section('content')



<head><script src="https://kit.fontawesome.com/bb800e133d.js" crossorigin="anonymous"></script></head>
    
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('/storage/images/products/'.$product->image)}}" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">{{$product->category}}</div>
                <h1 class="display-5 fw-bolder">{{$product->name}}</h1>

                <div class="fs-5 mb-5">
                    {{-- <span class="text-decoration-line-through">$45.\\\</span> --}}
                    <span>${{$product->price}}</span>
                </div>
                <p class="lead">{{$product->description}}</p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" oninput="getQuantity()" />
                    <form action= "{{route('add_to_cart')}}" method="POST">
                        @csrf
                          <input type="hidden" name="id" value="{{$product->id}}">
                          <input type="hidden" name="product_name" value="{{$product->name}}">
                          <input type="hidden" name="product_image" value="{{$product->image}}">
                          <input type="hidden" name="product_price" value="{{$product->price}}">
                          <input type="hidden" id="hiddenquantity" name="quantity" value="">
                          
                          <button type="submit" style="background: none; border:none">
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                    </form>
                   
                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



<script>
    $('#addStar').change('.star', function(e) {
    $(this).submit();
    });
</script>

<script>

function getQuantity()
{
    var quantityInput=document.getElementById("inputQuantity"); 
    var hiddenQuantity=document.getElementById("hiddenquantity");    
     hiddenQuantity.value=quantityInput.value;

  

}


</script>