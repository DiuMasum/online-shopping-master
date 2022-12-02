<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/create_product');
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
       /* $this->validate($request,[


            'weight' => 'required|min:1',

            'name' => 'required|min:1',

            'designation' => 'required|min:1',


             'photo'=>'required|min:1'
             ]);

             */


     if($request->hasfile('photo'))
      {
          $file = $request->file('photo');
          $name=time().$file->getClientOriginalName();
          $file->move(public_path().'/images/', $name);
      }

    
      $product=new Product;


      $product->name=$request->get('name');

      $product->description=$request->get('description');

      $product->price=$request->get('price');
      
      $product->type=$request->get('type');
       
      $product->image=$name;

      $product->save();

      /// echo "done";

     return redirect('/product_list')->with('success', true);

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
        $product =Product::find($id);
        return view('admin/product_edit',compact('product','id'));
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
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/images'), $image_name);
        }


        $form_data = array(
            'name'       =>   $request->name,
            'description'        =>  $request->description,
            'price'  =>   $request->price,
            'type'  =>   $request->type,

            'image'     =>   $image_name
        );

        Product::whereId($id)->update($form_data);

        ///echo "updated";

        return redirect('/product_list')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Models\Product::find($id);
        $product->delete();
        return redirect('/product_list')->with('success', true);
    }
}
