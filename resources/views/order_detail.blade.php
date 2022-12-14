@extends('layouts.main')

@section('content') 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
			.center-text
			{
				text-align: center;
			}
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
		
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
						
						</table>
					</td>
				</tr>

				@if ($order)
					
				
				<tr class="information">
					<td colspan="4">
						<table>
							<tr>
								<td>
									Bill to:<b> {{$order->user_name}}</b><br />
									Address:<b> {{$order->address}}</b><br />
									City: <b>{{$order->city}}</b><br/>
									Payment Method: <b>{{$order->payment_method}}</b><br />
									Delivery Method:<b> {{$order->delivery_method}}</b>

								</td>
								

								<td >
									{{-- Invoice #: {{$order->id}}<br /> --}}
									Date:<b> {{$order->created_at->format('d/m/Y')}}</b><br />
							
								</td>
							</tr>
						</table>
					</td>
				</tr>

				

			

				<tr class="heading">
					<td class="center-text">Item</td>
					<td class="center-text">Unit Price</td>
					<td class="center-text">Quantity</td>
					<td class="center-text">Price</td>
				</tr>

				@if (Session::has('cart'))
				@foreach(Session::get('cart') as $product)
				<tr class="item">
					<td class="center-text">{{$product['name']}}</td>
					<td class="center-text">{{$product['price']}}</td>
					<td class="center-text">{{$product['quantity']}}</td>
					<td class="center-text">${{$product['quantity']*$product['price']}}</td>
				</tr>
				@endforeach
				@endif
				@endif
				<tr class="heading">
					<td class="center-text">Total</td>
					<td class="center-text"></td>
					<td class="center-text"></td>
					<td class="center-text">${{Session::get('total')}}</td>
				</tr>

			</table>
         
		</div>
		{{-- <form action="{{route('exportpdf')}}" method="POST">
			
			<input type="hidden" name="user_id" value="{{$order->name}}">
			<input type="hidden" name="product_image" value="{{$order->user_name}}">
			{{-- <input type="hidden" name="product_price" value="{{$order->}}"> --}}
			{{-- <input type="hidden" name="quantity" value="1"> --}}
			{{-- <button type="submit" style="background: none; border:none"> --}}
			<a style="margin-left: 40%; margin-top:2%" href="{{url('view_pdf/'.$order->id)}}" class="btn btn-success" ><i class="bi bi-printer-fill">  Print</i></a>
			{{-- </button> --}}
		</form>
        <a style="margin-left: 5%;  margin-top:2%" href="{{url('/')}}" class="btn btn-success" ><i class="bi bi-house-door-fill"> Home</i></a>
	</body>
</html>


@endsection