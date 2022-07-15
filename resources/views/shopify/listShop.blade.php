@extends('layouts.master')

@section('title', 'List of Products')

@section('content')

<h2>List of Shopify</h2>
<p><a href="/shopify/createShopify" class="btn btn-primary">Create new products</a></p>
<div class="box-search">
    <form action="/shopify" method="get">
        <label for="name">Shop name: </label>
        <input type="text" id="name" name="name">
        {{ csrf_field()}}
        <button type="submit" value="Submit">Submit</button>
    </form>
</div>
<div>
  <a href="/api/createWebhook">createWebhook</a>
</div>

@stop