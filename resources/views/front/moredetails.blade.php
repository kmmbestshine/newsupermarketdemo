@extends('front.layouts.master')

@section('content')
    <!-- Jumbotron Header -->
    <div class="row text-center">
    @foreach ($products as $product)
        <div class="col-lg-5 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    {{--<p class="card-text">
                       {!! $product->description !!}

                    </p>--}}
                    <div class="content"><strong>{!! $product->full_descript !!}</strong> &nbsp;</div>
                    
                    <h2>More Details :</h2>
                    <p>Website :</p>

                    <h2 class="city">{{ $product->website }}</h2>
                    
                    <p>Price :</p>

                    <h2 class="city">{{ $product->studentprice }}</h2>

                    <h2 class="city">
                      Youtube Channel :
                      @if($product->video_site_link)
                        <a href="{{$product->video_site_link}}" class="cws-button bt-color-3 border-radius alt icon-right float-right">@lang('About Us More2')
                          <i class="fa fa-angle-right"></i>
                        </a>
                      @endif
                    </h2>
                    
                </div>
            </div>
        </div>

        @endforeach
        <div class="col-lg-7 col-md-6 mb-4">
            <h5 class="card-title">"Screen Shot"</h5>
            <div class="card">
               {{-- <img class="card-img-top" src="{{ url('/multipleuploads') . '/' . $product }}" alt=""> --}}
                <!-- Trigger the Modal -->
                @foreach ($temp as $product)
                <img id="myImg" src="{{ url('/multipleuploads') . '/' . $product }}" alt="Snow" style="width:100%;max-width:600px">

                <!-- The Modal -->
                <div id="myModal" class="modal">

                  <!-- The Close Button -->
                  <span class="close">&times;</span>

                  <!-- Modal Content (The Image) -->
                  <img class="modal-content" id="img01">

                  <!-- Modal Caption (Image Text) -->
                  <div id="caption"></div>
                </div>
                <br>
                @endforeach
            </div>
        </div>
    </div>
    
    <style>
        .city {
          background-color: tomato;
          color: white;
          padding: 10px;
          font-size: large;
        }
    </style>
    <style type="text/css">
                /* Style the Image Used to Trigger the Modal */
            #myImg {
              border-radius: 5px;
              cursor: pointer;
              transition: 0.3s;
            }

            #myImg:hover {opacity: 0.7;}

            /* The Modal (background) */
            .modal {
              display: none; /* Hidden by default */
              position: fixed; /* Stay in place */
              z-index: 1; /* Sit on top */
              padding-top: 100px; /* Location of the box */
              left: 0;
              top: 0;
              width: 100%; /* Full width */
              height: 100%; /* Full height */
              overflow: auto; /* Enable scroll if needed */
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }

            /* Modal Content (Image) */
            .modal-content {
              margin: auto;
              display: block;
              width: 80%;
              max-width: 700px;
            }

            /* Caption of Modal Image (Image Text) - Same Width as the Image */
            #caption {
              margin: auto;
              display: block;
              width: 80%;
              max-width: 700px;
              text-align: center;
              color: #ccc;
              padding: 10px 0;
              height: 150px;
            }

            /* Add Animation - Zoom in the Modal */
            .modal-content, #caption {
              animation-name: zoom;
              animation-duration: 0.6s;
            }

            @keyframes zoom {
              from {transform:scale(0)}
              to {transform:scale(1)}
            }

            /* The Close Button */
            .close {
              position: absolute;
              top: 45px;
              right: 35px;
              color: #f1f1f1;
              font-size: 40px;
              font-weight: bold;
              transition: 0.3s;
            }

            .close:hover,
            .close:focus {
              color: #bbb;
              text-decoration: none;
              cursor: pointer;
            }

            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
              .modal-content {
                width: 100%;
              }
            }

    </style>
    <script type="text/javascript">
    // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }
    </script>
@endsection