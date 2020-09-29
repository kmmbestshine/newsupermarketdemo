@extends('backend.layouts.master')
@section('title')
    Product create Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Site Product Management </h3>
                </div>
                
            </div>
            <div class="clearfix"></div>
            @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}
                </div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Create Product</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                    <form action="{{route('site.product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_name"> Category Name </label>
                                <input type="text" name="product_name" id="product_name" class="form-control" value="{{$product->category}}">
                            </div>
                            <div class="form-group">
                                <label for="product_name"> Product Name </label>
                                <input type="text" name="product_name" id="product_name" class="form-control" value="{{$product->name}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="price"> Price </label>
                                <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="cov_descript">Cover Description </label>

                                <textarea id="summernote" name="cov_descript" value="{{$product->description}}"> <p class="card-text"> {!! $product->description !!}</p></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description </label>
                                <textarea id="summernoteone" name="description" value="{{$product->full_descript}}"><p class="card-text"> {!! $product->full_descript !!}</p> </textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="studentprice">Student Price </label>
                                <input type="text" name="studentprice" id="studentprice" class="form-control" value="{{$product->studentprice}}">
                            </div>


                            <div class="form-group">
                                <label for="image">Cover </label>
                                <input type="file" name="image" id="image" class="form-control" value="{{$product->image}}">
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" name="images[]" id="images" class="form-control" value="{{$product->mul_images}}" multiple >
                                <small class="text-warning">You can use ctr (cmd) to select multiple images</small>
                            </div>
                            <i class="fa fa-link"></i>

                              <div class="form-group string optional profile_website">
                                <input class="string optional form-control" value="{{$product->website}}" type="text" name="profile[website]" id="profile_website">
                              </div>

                              <i class="fa fa-facebook"></i>
                              <div class="form-group url optional profile_facebook_url">
                                <input class="string url optional form-control" value="{{$product->facebook}}" type="url" name="profile[facebook_url]" id="profile_facebook_url">
                              </div>

                              <i class="fa fa-twitter"></i>
                              <div class="form-group url optional profile_twitter_url">
                                <input class="string url optional form-control" value="{{$product->twitter}}" type="url" name="profile[twitter_url]" id="profile_twitter_url">
                              </div>

                              <i class="fa fa-instagram"></i>
                              <div class="form-group url optional profile_instagram_url">
                                <input class="string url optional form-control" value="{{$product->instagram}}" type="url" name="profile[instagram_url]" id="profile_instagram_url">
                              </div>

                            <div class="form-group">
                               
                                <button type="submit" name="btnCreate" class="btn btn-primary" >Save Product</button>
                            </div>

                        </div>

                    </div>


                    <div class="clearfix"></div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('script')
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            var $foo = $('#name');
            var $bar = $('#slug');
            function onChange() {
                $bar.val($foo.val().replace(/\s+/g, '-').toLowerCase());
            };
            $('#name')
                .change(onChange)
                .keyup(onChange);
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        // General options
        selector: '#summernote',
        plugins: ['lists advlist',' textcolor'],
       // plugins: ['lists advlist',' textcolor','link image code fullscreen imageupload','uploadimage'],
        //toolbar: "forecolor backcolor",
        //toolbar: 'undo redo | insert | styleselect | fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | imageupload | code | fullscreen | print preview media | forecolor backcolor emoticons | codesample | mybutton',
        toolbar: 'undo redo | insert | styleselect | fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media | forecolor backcolor emoticons | codesample | mybutton',
       // toolbar2: 'print preview media | forecolor backcolor emoticons | codesample | mybutton',
        height : "250"
    });

</script>
<script>
    tinymce.init({
        // General options
        selector: '#summernoteone',
        plugins: ['lists advlist',' textcolor'],
       // plugins: ['lists advlist',' textcolor','link image code fullscreen imageupload','uploadimage'],
        //toolbar: "forecolor backcolor",
        //toolbar: 'undo redo | insert | styleselect | fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | imageupload | code | fullscreen | print preview media | forecolor backcolor emoticons | codesample | mybutton',
        toolbar: 'undo redo | insert | styleselect | fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media | forecolor backcolor emoticons | codesample | mybutton',
       // toolbar2: 'print preview media | forecolor backcolor emoticons | codesample | mybutton',
        height : "250"
    });

</script>
@endsection