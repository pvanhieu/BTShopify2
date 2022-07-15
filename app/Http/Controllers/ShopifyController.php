<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\Queue;

use App\Jobs\CreateProduct;
use GuzzleHttp\Client;      
use DB;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\Shopify;
use App\Models\ProductShopify;

class ShopifyController extends Controller
{
    public function shopify1123(Request $request)
    {
        if (isset($_GET['name'])) {
            $keyword = $_GET['name'];
            $shop = $keyword;
            $html = 'https://'.$shop.'.myshopify.com/admin/oauth/authorize?client_id=041fa7c5142b24d2964b83b74006dcc7&scope=write_orders,read_customers,read_products,write_products&redirect_uri=https://1241-113-161-32-170.ap.ngrok.io/shopify/url
            ';
            header("Location: " . $html);
            die();
        }
        return view('page');
    }

    public function generateCode(Request $request)
    {
        $code  =  $request->code;
        $domain = $request->shop;
       
        $dataToken = $this->getAccessToken($code,$domain);
       
        $accessToken = $dataToken->access_token;
        dd($accessToken);
        $client = new Client();
        $url = 'https://'. $domain . '/admin/api/2022-04/shop.json';
        $resShop = $client->request('GET', $url,[
            'headers' => [
                'X-Shopify-Access-Token' => $accessToken,
            ]
            ]);
        $dataToken = (array) json_decode($resShop->getBody());
        $getfilter = $dataToken['shop'];

        if(Shopify::where('email', $getfilter->email)->first()){
            Shopify::where('email', $getfilter->email)->update([
                'access_token' => $accessToken,
            ]);
        }else{
            Shopify::create([
                'name' => $getfilter->name,
                'domain' => $getfilter->$domain,
                'email' => $getfilter->email,
                'shopify_domain' => $getfilter->$domain,
                'plan_name' => $getfilter->plan_name,
                'password' => $getfilter->access_token
            ]);
        }

        $this->createWebhookProduct();

        return redirect()->route('getProducts');
    }
    /**
     * Get access token
     *
     * @param string $code
     * @param string $domain
     *
     * @return \stdClass
     */
    public function getAccessToken(string $code, string $domain)
    {
        $client  = new Client();
        $response = $client->request('POST',
            "https://".$domain."/admin/oauth/access_token",
            [
                'form_params' => [
                    'client_id' => '041fa7c5142b24d2964b83b74006dcc7',
                    'client_secret' => 'be20255d403ac9a98283f2012c3bf497',
                    'code' =>  $code,
                ]
            ]
        );
        // dd($response);
        return json_decode($response->getBody()->getContents());
    }

    //Start Create, Update, Delete Products with Webhook
    /**
     * 
     */
    public function createWebhookProduct()
    {
        $client  = new Client();
        $url  = 'https://pvhieu.myshopify.com/admin/api/2022-04/webhooks.json';
        $resShop = $client->request('POST', $url,[
            'headers' =>[
                'X-Shopify-Access-Token' =>'shpua_7b81aa36ca13a3a9133c5315b04f1056',
            ],
            'form_params'=>[
                'webhook' => [
                    'topic' => 'products/create',
                    'format' => 'json',
                    'address' => 'https://1241-113-161-32-170.ap.ngrok.io/pvhieu/api/createWebhookProduct',
                ],
            ]
        ]);
        dd($resShop->getBody()->getContents());
    }
    public function updateWebhookProduct()
    {
        $client  = new Client();
        $url  = 'https://pvhieu.myshopify.com/admin/api/2022-04/webhooks.json';
        $resShop = $client->request('POST', $url,[
            'headers' =>[
                'X-Shopify-Access-Token' =>'shpua_7b81aa36ca13a3a9133c5315b04f1056',
            ],
            'form_params'=>[
                'webhook' => [
                    'topic' => 'products/update',
                    'format' => 'json',
                    'address' => 'https://1241-113-161-32-170.ap.ngrok.io/pvhieu/api/updateWebhookProduct',
                    
                ],
            ]
        ]);
        dd($resShop->getBody()->getContents());
    }
    public function deleteWebhookProduct()
    {
        $client  = new Client();
        $url  = 'https://pvhieu.myshopify.com/admin/api/2022-04/webhooks.json';
        $resShop = $client->request('POST', $url,[
            'headers' =>[
                'X-Shopify-Access-Token' =>'shpua_7b81aa36ca13a3a9133c5315b04f1056',
            ],
            'form_params'=>[
                'webhook' => [
                    'topic' => 'products/delete',
                    'format' => 'json',
                    'address' => 'https://1241-113-161-32-170.ap.ngrok.io/pvhieu/api/updateWebhookProduct',
                    
                ],
            ]
        ]);
        dd($resShop->getBody()->getContents());
    }
    //End

    //Start Get, Create, Edit, Update, Delete Products 
    public function products()
    {
        $getProducts = DB::table('products_shopify')->get();
        return view('productshopify')->with('getProducts',$getProducts);
        
    }
    public function getProducts(Request $request)
    {
        $client = new Client();
        $url = 'https://pvhieu.myshopify.com/admin/api/2022-04/products.json';
      
        $resProducts  = $client->request('GET',$url,[
            'headers'=>[
                'X-Shopify-Access-Token' => 'shpua_7b81aa36ca13a3a9133c5315b04f1056'
            ],
        ]);

        $dataProducts = (array)json_decode($resProducts->getBody()->getContents());
        // dd($dataProducts);
        foreach($dataProducts['products'] as $item){
            if (empty(ProductShopify::find($item->id))) {
                $productShopify =[
                        'id' => $item->id,
                        'title' => $item->title,
                        'body_html' => $item->body_html,
                        'status' => $item->status,
                        // 'image' => $item->image,
                        'vendor' => $item->vendor,
                        'product_type' => $item->product_type
                ];
                ProductShopify::create($productShopify);
                // dd($productShopify);
            }
            
        }
        $getProducts = DB::table('products_shopify')->get();
    }
    public function editProducts($id)
    {
        $editproducts = DB::table('products_shopify')->where('id',$id)->get();

        return view('edit_productshopify')->with('editproducts',$editproducts);
    }

    public function updateProducts(Request $request)
    {
        $client = new Client();
        $url = 'https://pvhieu.myshopify.com/admin/api/2022-04/products/632910392.json';
      
        $resProducts  = $client->request('POST', $url, [
            'headers'=>[
                'X-Shopify-Access-Token' => 'shpua_7b81aa36ca13a3a9133c5315b04f1056',
                'Content-Type' =>'application/json'
            ],
                'form_params' =>[
                    'product' => [
                        'body_html' => $request->input('body_html'),
                        'status'=> $request->input('status'),
                        'vendor'=> $request->input('vendor'),
                        'image'=> $request->input('image'),
                        'product_type'=> $request->input('product_type')
                    ],
                ]
        ]);
         DB::table('shopify')->where('id',$id)->update($resProducts);    

        // return json_decode($resProducts->getBody()->getContents());
    }
    public function deleteProducts(Request $request, $id)
    {
        $client = new Client();
        $url = 'https://pvhieu.myshopify.com/admin/api/2022-04/products/' .$id. '.json';
      
        $resProducts  = $client->request('DELETE ', $url, [
            'headers'=>[
                'X-Shopify-Access-Token' => 'shpua_7b81aa36ca13a3a9133c5315b04f1056',
                'Content-Type' =>'application/json'
            ],
        ]);
        ProductShopify::where('id',$id)->delete();
        return redirect()->back();
        // DB::table('shopify')->where('id', $id)->delete();
        // return json_decode($resProducts->getBody()->getContents());
    }
    //End

    //Start Create, Edit, Update, Delete Products with Shopify
    public function createProductShopify(Request $request)
    {
        # code...
        $job =  new CreateProduct($request->all());
        dispatch($job)->delay(now()->addSecond(1));

    }
    //End
    public function Queue()
    {
        Queue::dispatch();
        Queue::dispatch()->delay(now()->addSecond(5));
    }
}
