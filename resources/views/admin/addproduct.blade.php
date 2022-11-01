@extends('layouts.main')

@section('content')
@if (count($errors) > 0)
  <div class="alert alert-danger" style="margin-left: 15rem">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif

  {!!Form::open(['action' => 'App\Http\Controllers\ProductController@saveproduct', 'method' => 'POST' , 'enctype' => 'multipart/form-data'])!!}
  {{ csrf_field() }}
    <!--  General -->
   <div class="form-row" style="margin: 2% 2% 2% 18%">
{{--     
    <div class="col-2">
      <label for="Date" class="mr-sm-2">Date:</label>
      {{-- <input type="date" class="form-control mb-2 mr-sm-2" placeholder="Enter Date" id="date" name="date" value="2013-01-08"> --}}
      {{-- <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" id="date" name="date" value="{{now()}}" readonly>
      
    </div> --}}
     
    <div class="col-4">
    <label for="product_name" class="mr-sm-2">Product Name:</label>
    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" id="product_name" name="product_name" value="{{old('product_name')}}">
  </div>

  <div class="col-4">
    <label for="product_price" class="mr-sm-2">Price:</label>
    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" id="product_price" name="product_price" value="{{old('product_price ')}}">
  </div>

  <div class="col-4">
    <label for="product_quantity" class="mr-sm-2">Quantity:</label>
    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" id="product_quantity" name="product_quantity" value="{{old('product_quantity')}}">
  </div>


  <div class="col-4">
    <label for="product_category" class="mr-sm-2">Category:</label>
    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" id="product_category" name="product_category" value="{{old('product_category')}}">
  </div>

  <div class="col-4">
    <label for="product_image" class="mr-sm-2">Image:</label>
    <input type="file" class="form-control mb-2 mr-sm-2" placeholder="" id="product_image" name="product_image" ">
  </div>

  <div class="col-6">
    <label for="product_description" class="mr-sm-2">Description</label>
    <textarea name="product_description" class="form-control mb-2 mr-sm-2" id="" rows="5" cols="40" name="product_description"></textarea>
  </div>


  <div class="col-12">
    {!!Form::submit('Save', ['class' => 'btn btn-success'])!!}
  </div>

   </div>

    {!!Form::close()!!}


@endsection
