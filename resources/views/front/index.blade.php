@extends('front.layouts.master')

@section('content')
    <!-- Jumbotron Header -->
        {{--<header class="jumbotron my-4">
            <h5 class="display-3"><strong>Welcome,</strong></h5>
            <p class="display-4"><strong>SALE UPTO 50%</strong></p>
            <p class="display-4">&nbsp;</p>
            <a href="#" class="btn btn-warning btn-lg float-right">SHOP NOW!</a>
        </header>--}}
 <header class="jumbotron my-4">
<div class="w3-content w3-section" style="max-width:500px">
  <img class="mySlides" src="assets/img/banner.png" style="width:210% ">
  <img class="mySlides" src="assets/img/banner2.png" style="width:210%">
  
</div>
</header>
    @if ( session()->has('msg') )
        <div class="alert alert-success">{{ session()->get('msg') }}</div>
    @endif
   
    <h2 class="w3-center" align="center">All Software Of {{$category->name}} </h2>
    <div class="row text-center">

    @foreach ($products as $product)
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card">
                {{--<img class="card-img-top" src="{{ url('/uploads') . '/' . $product->image }}" alt="">--}}
                {!! $product->intro_video_embed_code !!}
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                       {!! $product->description !!}
                    </p>
                </div>
                <div class="card-footer">
                    <strong>${{ $product->price }}</strong> &nbsp;
                    
                    
                </div>
                <div class="card-footer">
                   <form action="{{ route('moredetails') }}" method="post">
                        {{ csrf_field()}}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary btn-outline-dark"><i class="fa fa-bars"></i>Click More Details</button>
                    </form> 

                </div>
            </div>
        </div>

        @endforeach
    
       

    </div>
    <script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
@endsection