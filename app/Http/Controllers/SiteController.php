<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Mail\OrderCreatedEmail;
use Illuminate\Support\Facades\Mail;

///use App\Models\Product;


class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        view()->share('products',$products);
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Session::get('cart');
        
        $first_name = $request->input('first_name');
        $address = $request->input('address');
        $last_name = $request->input('last_name');
        $zip = $request->input('zip');
        $phone = $request->input('phone');
        $email = $request->input('email');
 
 
 
 
     //check if user is logged in or not
        $isUserLoggedIn = Auth::check();
 
       if($isUserLoggedIn){
           //get user id
          $user_id = Auth::id();  //OR $user_id = Auth:user()->id;
 
       }else{
           //user is guest (not logged in OR Does not have account)
         $user_id = 0;
 
       }
       
 
 
 
         //cart is not empty
         if($cart) {
         // dump($cart);
             $date = date('Y-m-d H:i:s');
             $newOrderArray = array("user_id" => $user_id, "status"=>"on_hold","date"=>$date,"del_date"=>$date,"price"=>$cart->totalPrice,
             "first_name"=>$first_name, "address"=> $address, 'last_name'=>$last_name, 'zip'=>$zip,'email'=>$email,'phone'=>$phone);
             
             $created_order = DB::table("orders")->insert($newOrderArray);
             $order_id = DB::getPdo()->lastInsertId();;
 
 
             foreach ($cart->items as $cart_item){
                 $item_id = $cart_item['data']['id'];
                 $item_name = $cart_item['data']['name'];
                 $item_price = $cart_item['data']['price'];
                 $newItemsInCurrentOrder = array("item_id"=>$item_id,"order_id"=>$order_id,"item_name"=>$item_name,"item_price"=>$item_price);
                 $created_order_items = DB::table("order_items")->insert($newItemsInCurrentOrder);
             }
 
 
             //send the email
 
             //delete cart
             Session::forget("cart");
             
             
 
 
             $payment_info =  $newOrderArray;
             $payment_info['order_id'] = $order_id;
             $request->session()->put('payment_info',$payment_info);
 
           print_r($newOrderArray);
             
         // return redirect()->route("showPaymentPage");
 
         }else{
 
           return redirect()->route("allProducts");
 
      
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
