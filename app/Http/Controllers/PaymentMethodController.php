<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    function paymentmethodlist()
    {
        $payment_methods=PaymentMethod::all();
        
        return view('admin.paymentmethodlist')->with('payment_methods',$payment_methods);
    }

    function setuppaymentmethod()
    {
        return view('admin.setuppaymentmethod');


    }
   public function savepaymentmethod(Request $request)
    {
       
        $request->validate(
            [
            'name'=>'required',
            ]
        );
        $payment_method=new PaymentMethod();
        $payment_method->name=$request->input('name');
        $payment_method->save();
        
        return back()->with('status', 'Payment Method has been added!');

    }
    function editpaymentmethod($id)
    {
        $payment_method=PaymentMethod::find($id);
        return view('admin.editpaymentmethod')->with('payment_method',$payment_method);

    }

    function updatepaymentmethod(Request $request)
    { 
        $payment_method=PaymentMethod::find($request->input('id'));
        $payment_method->name=$request->input('name');
        $payment_method->update();
        return back()->with('status', 'Payment Method has been edited!');
        
    }
    function deletepaymentmethod($id)
    {

        $payment_method=PaymentMethod::find($id);
        $payment_method->delete();
        return back()->with('status', 'Payment Method has been deleted!');

    }
   
}
