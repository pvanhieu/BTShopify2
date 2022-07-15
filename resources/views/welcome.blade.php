<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
@extends('shopify-app::layouts.default')

@section('content')
    <!-- You are: (shop domain name) -->
    <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection

<main>
    <section>
        <div class="card">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 15%">ID</th>
                        <th style="width: 15%">Images</th>
                        <th style="width: 15%">Title</th>
                        <th >Description</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $shop  = Auth::user();
    
                    $products = $shop->api()->rest('GET','/admin/api/2022-04/products.json',['limit' => 5]);
                    $products = $products['body']['container']['products'];
    
                    // print_r($products);
    
                    foreach ($products as $product ) {
                        # code...
                        $image ='';
                        if(count($product['images']) > 0){
                            $image = $product['images'][0]['src'];
                        }
                        ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><img width="100px" height="100px" src="<?php echo $image; ?>" alt="<?php echo $product['title']; ?>"></td>
                            <td><?php echo $product['title']; ?></td>
                            <td><?php echo $product['body_html']; ?></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    // DB::table('shopify')->insert($product);
                    ?>
                </tbody>
            </table>
           
        </div>
    </section>
</main>
</body>
</html>