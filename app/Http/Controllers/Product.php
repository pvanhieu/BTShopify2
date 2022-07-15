<?php

namespace App\Http\Controllers;
use DB;
use Log;
use Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class Product extends Controller
{
    public function create_products(Request $request){
        $data['title'] = $request ->title;
        $data['price'] = $request ->price;
        $data['quantity'] = $request ->quantity;
        $data['status'] = $request ->status;
        $data['description'] = $request ->description;
        $data['img'] = $request ->image;
        DB::table('product')->insert($data);

         return redirect('product');
    }
    public function product()
    {
        $all_product = DB::table('product')->paginate(5);
        if($keyword= request()->keyword_search){
            $all_product = DB::table('product')->where('name','like','%'.$keyword.'%' )->paginate(5);
        }

        return view('products')->with('all_product',$all_product);
    }
    public function edit_Product($id_product)
    {
        $edit_product = DB::table('product')->where('id_products',$id_product)->get();

        return view('edit_product')->with('edit_product',$edit_product);
    }
   
    public function update_Product(Request $request, $id_product)
    {
        $data = array();
        $data['name'] = $request ->name;
        $data['title'] = $request ->title;
        $data['price'] = $request ->price;
        $data['quantity'] = $request ->quantity;
        $data['status'] = $request ->status;
        $data['description'] = $request ->description;
        $data['img'] = $request ->image;

        DB::table('product')->where('id_products',$id_product)->update($data);

        return redirect('product');

    }
    public function delete_Product($id_product)
    {
        $edit_product = DB::table('product')->where('id_products',$id_product)->delete();

        return redirect('product');
    }
    public function search_Product(Request $request)
    {   
        if (isset($_GET['keyword_search_1'])) {
            $keyword = $_GET['keyword_search_1'];
            $search_product = DB::table('product')->where('title', 'like', '%'.$keyword. '%')->get();
        }
        if(isset($_GET['keyword_search_2'])) {
            $keyword = $_GET['keyword_search_2'];
            $search_product = DB::table('product')->where('status',$keyword)->get();
        }
        
        return view('search_product')->with('search_product',$search_product);
    }

    
}