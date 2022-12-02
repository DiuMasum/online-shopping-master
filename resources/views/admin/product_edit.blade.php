@extends('layouts.site_admin')

@section('content')


<div class="panel panel-default">
                        <div class="panel-heading">
                            <center>Update Product</center>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                {!! Form::open(['url' => URL::to('/product/'.$product->id), 'method'=>"put", 'id'=>'event', 'enctype'=>'multipart/form-data']) !!}
                                @csrf
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text"  name="name" placeholder="Enter name of product" value="{{$product->name}}" class="form-control" />
                                    @if ($errors->first('name'))<div class="alert alert-danger">{!! $errors->first('name') !!}</div> @endif

                                </div>





                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input type="text"  name="description" placeholder="Enter description" value="{{$product->description}}" class="form-control" />
                                            @if ($errors->first('description'))<div class="alert alert-danger">{!! $errors->first('description') !!}</div> @endif

                                        </div>




                                        <div class="form-group">
                                        <label>Price:</label>
                                            <input type="text"  name="price" value="{{$product->price}}" placeholder="Enter price" class="form-control" />
                                            @if ($errors->first('price'))<div class="alert alert-danger">{!! $errors->first('price') !!}</div> @endif
                                        </div>

                                        <div class="form-group">
                                        <label>Type:</label>
                                            <input type="text"  name="type" value="{{$product->type}}" placeholder="Enter category" class="form-control" />
                                            @if ($errors->first('type'))<div class="alert alert-danger">{!! $errors->first('type') !!}</div> @endif
                                        </div>





                                        <div class="form-group">
                                        <label>Upload Photo:</label>
                                        <input type="file" name="image" />




                                        <input type="hidden" name="hidden_image" value="{{ $product->image}}" />
                                            @if ($errors->first('photo'))<div class="alert alert-danger">{!! $errors->first('photo') !!}</div> @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Previous Image:</label>
                                            <img src="{{ asset('images/' . $product->image) }}" alt="" height="90px" width="120">
                                            </div>


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>



    </div>


@endsection