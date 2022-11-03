<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shopping Cart System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">   --}}

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('css/flaticon.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('css/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    {{-- bootstrap --}}
    
  
<style>

.dropdown {
  display: inline-block;
  position: relative;
  z-index:100;
}
.dropdown-content {
  display: none;
  position: absolute;
  width: 100%;
  overflow: auto;
  box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.4);
}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown-content a {
  display: block;
  color: #000000;
  padding: 5px;
  text-decoration: none;
}
.dropdown-content a:hover {
  color: #FFFFFF;
  background-color: #00A4BD;
}
</style>

</head>

<body>
    {{-- <!-- Topbar Start -->
    <div class="container-fluid border-bottom d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center py-2">
                <div class="d-inline-flex align-items-center">
                    <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Our Office</h6>
                        <span>123 Street, New York, USA</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center border-start border-end py-2">
                <div class="d-inline-flex align-items-center">
                    <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Email Us</h6>
                        <span>info@example.com</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center py-2">
                <div class="d-inline-flex align-items-center">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Call Us</h6>
                        <span>+012 345 6789</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End --> --}}
    {{-- <span class="bi bi-cart-dash"></span> --}}

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="{{url('/')}}" class="navbar-brand ms-lg-5">
            <h1 class="m-0 text-uppercase text-dark"><i class="bi bi-cart-dash fs-1 text-primary me-3">Amazing</i></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (Auth::check())
        @if (Auth::user()->role==1)

        
        <div class="dropdown" >

          
                <button class="btn  dropdown-toggle" aria-expanded="true" >     Admin Setup     </button>
                <div class="dropdown-content">
                    <a  href="{{route('productlist')}}">Products</a>
                    <a  href="{{route('deliverymethodlist')}}">Delivery Method</a>
                    <a  href="{{route('paymentmethodlist')}}">Payment Method</a>
          </div>
           
            {{-- <button class="btn  dropdown-toggle"id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Admin
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="{{route('productlist')}}">Manage Products</a></li>
              <li><a class="dropdown-item" href="{{route('deliverymethodlist')}}">Setup Delivery Method</a></li>
              <li><a class="dropdown-item" href="{{route('paymentmethodlist')}}">Setup Payment Method</a></li>
            </ul> --}}
      
        </div> 
          
          @endif

                
          @endif

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">

               
                    {{-- <a href="{{route('productlist')}}" class="nav-item nav-link active">Manage Products</a> --}}
                    
              
                
                <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
                <a href="{{Route('products')}}" class="nav-item nav-link">Products</a>

                @if (Auth::check())
                <form action="{{route('dologout')}}" method="POST">
                    @csrf
                    <div class="nav-item">
                        <a class="nav-link"  onclick="event.preventDefault();
                                    this.closest('form').submit(); " role="button">
                            <i class="fas fa-sign-out-alt"></i>
            
                            {{ __('Log out') }}
                        </a>
                    </div>
                    </div>
                    </form>
                @else
                <a href="{{route('login')}}" class="nav-item nav-link">Log in</a>
              
                @endif
               
                
                
        
                <a href="{{route('cart')}}" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Cart <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </nav>

    <script>
        $(function() {
  $('.dropdown-toggle').click(function(e) {
    e.preventDefault();
    $(this).parent().toggleClass('open');
  });
});
    </script>
    <!-- Navbar End -->