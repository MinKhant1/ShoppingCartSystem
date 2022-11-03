<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{
    //

    function deliverymethodlist()
    {
        $delivery_methods=DeliveryMethod::all();
        
        return view('admin.deliverymethodlist')->with('delivery_methods',$delivery_methods);
    }

    function setupdeliverymethod()
    {
        return view('admin.setupdeliverymethod');


    }
   public function savedeliverymethod(Request $request)
    {
       
        $request->validate(
            [
            'name'=>'required',
            ]
        );
        $delivery_method=new DeliveryMethod();
        $delivery_method->name=$request->input('name');
        $delivery_method->save();
        
        return back()->with('status', 'Delivery Method has been added!');

    }
    function editdeliverymethod($id)
    {
        $delivery_method=DeliveryMethod::find($id);
        return view('admin.editdeliverymethod')->with('delivery_method',$delivery_method);

    }

    function updatedeliverymethod(Request $request)
    { 
        $delivery_method=DeliveryMethod::find($request->input('id'));
        $delivery_method->name=$request->input('name');
        $delivery_method->update();
        return back()->with('status', 'Delivery Method has been edited!');
        
    }
    function deletedeliverymethod($id)
    {

        $delivery_method=DeliveryMethod::find($id);
        $delivery_method->delete();
        return back()->with('status', 'Delivery Method has been deleted!');

    }
   


}
