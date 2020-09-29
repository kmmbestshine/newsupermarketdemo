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
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 130px;">
                            <div class="input-group">
                                <a href="{{route('site.product.list')}}" class="btn btn-success">View Product</a>
                            </div>
                        </div>
                    </div>
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
                    <form action="{{route('site.product.store')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_name"> Category Name </label>
                                <select class="form-control" id="category_name" name="category_name" style="height: 38px; width: 300px">
                                <option value="">Select Category</option>
                                @foreach($category as $m)
                                    <option value="{{$m->slug}}">{{$m->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name"> Product Name </label>
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder='Enter Product Name'>
                            </div>
                            
                            <div class="form-group">
                                <label for="price"> Price </label>
                                <input type="text" name="price" id="price" class="form-control" placeholder='Enter Price'>
                            </div>
                            
                            <div class="form-group">
                                <label for="cov_descript">Cover Description </label>
                                <textarea id="summernote" name="cov_descript" placeholder='Enter Cover Description'> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description </label>
                                <textarea id="summernoteone" name="description" placeholder='Enter Description'> </textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="studentprice">Student Price </label>
                                <input type="text" name="studentprice" id="studentprice" class="form-control" placeholder='Enter studentprice'>
                            </div>


                            <div class="form-group">
                                <label for="image">Cover </label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <small class="text-warning">You can use ctr (cmd) to select multiple images</small>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="intro_video_embed_code">Introduction Video Embed Code<span class="text-danger">*</span> </label>
                                <input  type="text" class="form-control" name="intro_video_embed_code"  placeholder="codes"  required>
                                <span class="glyphicon glyphicon-info form-control-feedback"></span>
                                <span class="text-danger">{{ $errors->first('intro_video_embed_code') }}</span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="video_site_link">More Video Site Link</label>
                                <input  type="url" class="form-control" name="video_site_link"  placeholder="url"  minlength="8" maxlength="500">
                                <span class="glyphicon glyphicon-info form-control-feedback"></span>
                                <span class="text-danger">{{ $errors->first('video_site_link') }}</span>
                            </div>
                            <i class="fa fa-link"></i>

                              <div class="form-group string optional profile_website">
                                <input class="string optional form-control" placeholder="http://your-website.com" type="text" name="profile[website]" id="profile_website">
                              </div>

                              <i class="fa fa-facebook"></i>
                              <div class="form-group url optional profile_facebook_url">
                                <input class="string url optional form-control" placeholder="http://facebook.com/your-account" type="url" name="profile[facebook_url]" id="profile_facebook_url">
                              </div>

                              <i class="fa fa-twitter"></i>
                              <div class="form-group url optional profile_twitter_url">
                                <input class="string url optional form-control" placeholder="http://twitter.com/your-account" type="url" name="profile[twitter_url]" id="profile_twitter_url">
                              </div>

                              <i class="fa fa-instagram"></i>
                              <div class="form-group url optional profile_instagram_url">
                                <input class="string url optional form-control" placeholder="http://instagram.com/your-account" type="url" name="profile[instagram_url]" id="profile_instagram_url">
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