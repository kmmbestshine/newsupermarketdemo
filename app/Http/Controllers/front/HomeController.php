<?php

namespace App\Http\Controllers\front;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\front\HomeController;

class HomeController extends Controller
{

    public function index() {
        //dd('jjjjj');
                $category = \DB::table('site_category')->first();
        $products = \DB::table('siteproducts')->where('category',$category->slug)->get();
        //$category = \DB::table('site_category')->get();


        return view('front.index', compact('products','category'));
    }
    public function moredetails() {
    	$input = \Request::all();
    	
        $products = \DB::table('siteproducts')->where('id', $input['id'])->get();
        foreach ($products as $product) {
            $mul_images=$product->mul_images;
        }

        $temp = explode('|',$mul_images );
        
        return view('front.moredetails', compact('products','temp'));
    }
    public function contactUs()
    {
       // dd('hhhhhh');
        return view('front.contact');
    }
    public function showcategoryproduct()
    {
        $input = \Request::all();
        $category = \DB::table('site_category')->where('id',$input['id'])->first();
        $products = \DB::table('siteproducts')->where('category',$category->slug)->get();
        //dd('hhhhhh',$products,$category);
        //return view('front.contact');
        return view('front.catproductindex', compact('products','category'));
    }
}
