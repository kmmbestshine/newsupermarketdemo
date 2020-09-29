<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {

        $products = \DB::table('siteproducts')->get();
        //dd($products);
        return view('backend.site.products.index', compact('products'));
    }
    public function categoryindex() {
                $category = \DB::table('site_category')->get();
        
        return view('backend.site.category.list', compact('category'));
    }
    public function categoryedit($id)
    {
             
        $productcategory  = \DB::table('site_category')->find($id);
        return view('backend.site.category.edit',compact('productcategory'));
    }
    public function categoryupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        $pc = \DB::table('site_category')->where('site_category.id',$id)->limit(1);
        
        $message=$pc->update([
           'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s'),
            'modified_by' =>  Auth::user()->username
        ]);
            return redirect()->route('site.category.list')->with('success_message', 'successfully updated');
    }
    public function categorydestroy($id)
    {
       // $check = $this->checkpermission('productcategory-delete');
         $productcategory = \DB::table('site_category')->where('site_category.id',$id)->limit(1);
            $message = $productcategory->delete();
            if ($message) {
                return redirect()->route('site.category.list')->with('success_message', 'successfully Deleted');
            }
        
        
    }

    public function create() {

       // $product = new Product();
        $category = \DB::table('site_category')->get();
        //dd('kkkkkkkkk',$product);
        return view('backend.site.products.create', compact('category'));
    }

    public function store(Request $request) {
        $input = \Request::all();
        
        // Validate the form
        
        //dd($input);
        // Upload the image
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }
        //dd($input, $request,$image,$request->product_name);
        // Upload the multible images
        $images=array();
        if ($files=$request->file('images')) {
            foreach ($files as $file) {
                $name=$file->getClientOriginalName();
                $file->move('multipleuploads',$name);
                $images[]=$name;
            }
            
        }
    /*Insert your data*/

        DB::table('siteproducts')->insert(
                array(
            'category' => $request->category_name,
            'name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->cov_descript,
            'full_descript' => $request->description,
            'image' => $request->image->getClientOriginalName(),
            'mul_images' => implode("|",$images),
            'intro_video_embed_code' => $request->intro_video_embed_code,
            'video_site_link' => $request->video_site_link,
            'website' => $request->webste,
            'youtube' => $request->youtube_url,
            'studentprice' => $request->studentprice,

        ));
        

        // Sessions Message
        $request->session()->flash('msg','Your product has been added');
//dd($input);
        // Redirect

        return redirect('site/products/create');

    }

    public function edit($id) {
        //dd($id);
        $product = \DB::table('siteproducts')->find($id);
        return view('backend.site.products.edit', compact('product'));
    }

    public function update(Request $request, $id) {
        dd($id,'ppppppppp');
        // Find the product
        $product = Product::find($id);

        // Validate The form
        $request->validate([
           'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        // Check if there is any image
        if ($request->hasFile('image')) {
            // Check if the old image exists inside folder
            if (file_exists(public_path('uploads/') . $product->image)) {
                unlink(public_path('uploads/') . $product->image);
            }

            // Upload the new image
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());

            $product->image = $request->image->getClientOriginalName();
        }

        // Updating the product
        $product->update([
           'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Product has been updated');

        // Redirect
        return redirect('admin/products');

    }

    public function show($id) {
        $product = Product::find($id);
        return view('admin.products.details', compact('product'));
    }


    public function destroy($id) {
       // dd('kkk',$id);
        $product = \DB::table('siteproducts')->where('siteproducts.id',$id)->limit(1);
            $message = $product->delete();
            if ($message) {
                return redirect()->route('site.product.list')->with('success_message', 'successfully Deleted');
            }

    }
    public function categorycreate() {

        $product = new Product();
        //dd('kkkkkkkkk',$product);
        return view('backend.site.category.create', compact('product'));
    }
     public function categorystore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        $message =DB::table('site_category')->insert(
                array(
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'created_by' => Auth::user()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ));
        if ($message) {
            return redirect()->route('site.category.create')->with('success_message', 'successfully created ');
        } else {
            return redirect()->route('site.category.create')->with('error_message', 'Failed To create');
        }
    }

    
}
