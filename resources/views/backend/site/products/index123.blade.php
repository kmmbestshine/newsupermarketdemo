@extends('backend.layouts.master')

@section('page')
    View Products
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="header">
                    <h4 class="title">Site Products</h4>
                    <p class="category">List of all products</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td><div class="content">{!! $product->description !!}</div></td>
                                <td><img src="{{ url('uploads').'/'. $product->image }}" alt="{{ $product->image }}" style="width:50px;" class="img-thumbnail"></td>
                                <td>

                                    
                                    <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <form action="{{route('site.category.delete' ,$product->id)}}" method="post">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field()}}
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o"></i> Delete</button>
                                                        <a href="{{route('site.category.edit',$product->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="{{route('site.category.edit',$product->id)}}" class="btn btn-info"><i class="fa fa-list"></i> Edit</a>
                                                    </form>
                                                </div>
                                            </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

<style>
table, th, td {
  border: 1px solid black;
}
</style>
@endsection