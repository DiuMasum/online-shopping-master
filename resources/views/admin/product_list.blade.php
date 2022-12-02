@extends('layouts.site_admin')

@section('content')

<div class="panel panel-default">
                        <div class="panel-heading">
                            <center>Executive Committee</center>
                        </div>

                        @if (session()->has('success'))

<div class="alert alert-success">
    <i>Action completed successfully</i><br>
</div>
@endif




<br>


<br>
<table class="table table-striped">
<thead>
<tr>




<th><center>Name</center></th>
<th><center>Image</center></th>
<th><center>Description</center></th>
<th><center>Price</center></th>
<th><center>Type</center></th>



<th colspan="2"><center></center></th>
</tr>

@foreach($products as $product)
<tr>

<td><center>{{$product->name}}</center></td>
<td><center>

<img src="{{ asset('images/' . $product->image) }}" alt="" height="75px" width="80px"></center></td>
<td><center>{{$product->description}}</center></td>
<td><center>{{$product->price}}</center></td>
<td><center>{{$product->type}}</center></td>



<td><center><a class="btn btn-xs btn-warning" href="/" role="button">view</a></center></td>


<td>{!! Form::open(['url' => URL::to('/product/'.$product->id),"method"=>"DELETE"]) !!}
    <button type="submit" class="btn btn-xs btn-danger"><i class="fa  fa-trash-o"></i></button>
    {!! Form::close() !!}</td>
<td>
<td>
<a href="{{ URL::to('/product/'.$product->id.'/edit') }}" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-edit"></i></a>
</td>
</td>

<!-- Modal content -->

</tr>
@endforeach
</table>



        </div>
    </div>





    @endsection