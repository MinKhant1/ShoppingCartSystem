<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Session;

class PdfController extends Controller
{
    //

    public function view_pdf($id){

        Session::put('id', $id);
        try{
            $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHTML($this->convert_orders_data_to_html());

            return $pdf->stream();
        }
        catch(Exception $e){
            return redirect('/order_detail')->with('error', $e->getMessage());
        }
    }

    public function convert_orders_data_to_html(){

        $order = Order::find(Session::get('id'));
    



        // foreach($orders as $order){
        //     $name = $order->name;
        //     $address = $order->address;
        //     $date = $order->created_at;
        // }

        // $orders->transform(function($order, $key){
        //     $order->cart = unserialize($order->cart);

        //     return $order;
        // });

        $output="<head>
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
		</style></head>";

        $output.='<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
						
						</table>
					</td>
				</tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Bill to: <b>'.$order->user_name.'</b><br />
									Address:<b> '.$order->address.'</b><br />
									City: <b>'.$order->city.'</b><br/>
									Payment Method:<b> '.$order->payment_method.'</b><br />
									Delivery Method:<b> '.$order->city.'</b>

								</td>

								<td>
									
									Date: <b>'.$order->created_at->format('d/m/Y').'</b><br />
							
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
		';


       
        if(session()->exists('cart'))
        {
        foreach(session()->get('cart') as $product)
        {
            $output.='<tr>
            <td class="center-text">'.$product['name'].'</td>
            <td class="center-text">'.$product['price'].'</td>
            <td class="center-text">'.$product['quantity'].'</td>
            <td class="center-text">$'.$product['quantity']*$product['price'].'</td>
        </tr>
		';
        }

		
    }
	$total=session()->get('total');

	$output.='<tr class="heading">
	<td class="center-text">Total</td>
	<td class="center-text"></td>
	<td class="center-text"></td>
	<td class="center-text">'.$total.'</td>
</tr>';
        $output.='</table></div>';
      

        

        // $output = '<link rel="stylesheet" href="frontend/css/style.css">
        //                 <table class="table">
        //                     <thead class="thead">
        //                         <tr class="text-left">
        //                             <th>Client Name : '.$name.'<br> Client Address : '.$address.' <br> Date : '.$date.'</th>
        //                         </tr>
        //                     </thead>
        //                 </table>
        //                 <table class="table">
        //                     <thead class="thead-primary">
        //                         <tr class="text-center">
        //                             <th>Image</th>
        //                             <th>Product name</th>
        //                             <th>Price</th>
        //                             <th>Quantity</th>
        //                             <th>Total</th>
        //                         </tr>
        //                     </thead>
        //                     <tbody>';
        
        // foreach($orders as $order){
        //     foreach($order->cart->items as $item){

        //         $output .= '<tr class="text-center">
        //                         <td class="image-prod"><img src="storage/product_images/'.$item['product_image'].'" alt="" style = "height: 80px; width: 80px;"></td>
        //                         <td class="product-name">
        //                             <h3>'.$item['product_name'].'</h3>
        //                         </td>
        //                         <td class="price">$ '.$item['product_price'].'</td>
        //                         <td class="qty">'.$item['qty'].'</td>
        //                         <td class="total">$ '.$item['product_price']*$item['qty'].'</td>
        //                     </tr><!-- END TR-->
        //                     </tbody>';

        //     }

        //     $totalPrice = $order->cart->totalPrice; 

        // }

        // $output .='</table>';

        // $output .='<table class="table">
        //                 <thead class="thead">
        //                     <tr class="text-center">
        //                             <th>Total</th>
        //                             <th>$ '.$totalPrice.'</th>
        //                     </tr>
        //                 </thead>
        //             </table>';


        return $output;
                
    

    }
}
