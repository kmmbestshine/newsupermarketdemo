<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Salescart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use PDF;

class SalesController extends Controller
{
    public function create()
    {
        
        $this->checkpermission('sales-create');

        $salescart = Salescart::all();
        //dd('jjjjjjjjjj',$salescart);
        return view('backend.sales.create', compact( 'salescart'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'product_id' => 'required',
            'price' => 'required',
            'sales_quantity' => 'required',
        ]);
        
        if ($request->ajax()) {
           // dd($request->sales_status);
            $sales = new Salescart();
            if($request->sales_status ==1){
                
            $sales->product_id = $request->product_id;
            $sales->quantity = $request->sales_quantity;
            $sales->price = $request->price * $request->sales_quantity;
            $sales->sales_status = $request->sales_status;
            $sales->saller_name = Auth::user()->username;
            $sales->sales_date = date('Y-m-d');
            }else{
               
            $sales->product_id = $request->product_id;
            $sales->quantity = $request->sales_quantity;
            $sales->price = $request->price * $request->sales_quantity;
            $sales->sales_status = $request->sales_status;
            $sales->buyer_name = $request->creditorName;
            $sales->phone = $request->creditorPh;
            $sales->address = $request->place;
            $sales->saller_name = Auth::user()->username;
            $sales->sales_date = date('Y-m-d');
            }
            
            if ($sales->save()) {
                $product = Product::find($request->product_id);
                $product->stock = $product->stock - $request->sales_quantity;
                if ($product->update()) {
                    return response(['success_message' => 'SuccessFully Make sales']);
                }
            }

        } else {
            return response(['error_message' => 'Filed To Make sales']);
        }
    }

    public function index()
    {
        $this->checkpermission('sales-list');
        $sales = Sale::join('products', 'products.id', '=', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->orderBy('sales.created_at', 'DEC')
            ->get();
        return view('backend.sales.list', compact('sales'));
    }

    public function ajaxlist()
    {
        $sales = Salescart::join('products', 'products.id', '=', 'salescarts.product_id')
            ->select('salescarts.*', 'products.name')
            ->orderBy('salescarts.created_at', 'DEC')
            ->get();
       // dd($sales);
        return view('backend.sales.ajaxlist', compact('sales'));
    }

    public function ajaxform()
    {
        $salescart = Salescart::all();
        //dd($salescart);
        return view('backend.sales.ajaxform', compact('salescart'));
    }

    public function refreshproduct()
    {
        $product = Product::where('stock', '>=', 1)->get();
        return view('backend.sales.refreshproduct', compact('product'));
    }

    public function getquantity(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->stock;

    }

    public function getprice(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->price;
    }

    public function getproductname(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->name;
    }

    public function getallpdf()
    {
        $report = Salescart::join('products', 'products.id', '=', 'salescarts.product_id')
            ->select('salescarts.*', 'products.name')
            ->get();
        return view('backend.pdfbill.salesbill', compact('report'));
    }

    public function getcustomreport(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $sales_status=$request->report_type;
        if($sales_status==1){
            $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->whereBetween('sales.sales_date', [$start, $end])
            ->where('sales.sales_status', 1)
            ->get();
        $report_type="Cash";
        }
        if($sales_status==0){
            $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->whereBetween('sales.sales_date', [$start, $end])
            ->where('sales.sales_status', 0)
            ->get();
        $report_type="Credit";
        }
        if($sales_status=="all"){
            $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->select('sales.*', 'products.name')
            ->whereBetween('sales.sales_date', [$start, $end])
            ->get();
        $report_type="Cash And Credit ";
        }
        
        $pdf = PDF::loadview('backend.pdfbill.allreport', compact('report', 'start', 'end','report_type'));
        return $pdf->download('salesreport.pdf');
    }

    public function savetosales(Request $request)
    {
        $input = \Request::all();
        //dd('hhhhhh',$input,$request,$request['custname']);
        for ($i = 0; $i < $request->input('total_product'); $i++) {

            
                $od = [
                'product_id' => $request['product_id'][$i],
                'quantity' => $request['quantity'][$i],
                'price' => $request['price'][$i],
                'sales_status' => $request['sales_status'][$i],
                'saller_name' => Auth::user()->username,
                'sales_date' => date('Y-m-d'),
                'customerName' => $request['custname'],
                'phone_no' => $request['phone'],
                'address' => $request['address']
            ];
            
            
            
            //dd($od);

            Sale::create($od);
            //dd('inserted',$request->input('total_product'));
        }
        DB::table('salescarts')->delete();
        return redirect()->back()->with('success_message', 'Successfuly Clear Your Bucket and Sales Item store in Sales Record');

    }

    public function deletecart($id, $pid)
    {
        $product = Product::find($pid);
        $salescart = Salescart::find($id);
        $product->stock = $product->stock + $salescart->quantity;
        if ($product->update()) {
            $salescart->delete();
            return redirect()->back()->with('success_message', 'Seccessfully deleted Item');
        }else {
            return redirect()->back()->with('error_messsage', 'Failed To Delete Item');
        }
    }
}
