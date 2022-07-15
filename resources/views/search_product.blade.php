<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="../MyScript/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../MyScript/mystyle.css">
</head>
<body>
	<div class="row">
		<div class="md-3">
		</div>
		<div class="col-md-9">
			<h1>Kết quả tìm kiếm</h1>
		<table style=" border: black 1px solid; text-align: center;">
			<tr style="background: #867979;">
				
				<th>Product ID</th>
				<th>Image</th>
				<th width="20%">Product Name</th>
				<th width="20%">Title</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Status</th>	
				<th width="20%">Description</th>
				<td width="20%">Action</td>
			</tr>
			@foreach ($search_product as $item => $value)
			<tr>
                <td>{{$value->id_products}}</td>
				<td>{{$value->img}}</td>
				<td>{{$value->name}}</td>
				<td>{{$value->title}}</td>
				<td>{{$value->price}}</td>
				<td>{{$value->quantity}}</td>
				<td>
					<?php
						if($value->status == 0){
							echo 'Pending';
						}elseif($value->status ==1){
							echo 'Aprove';
						}else{
							echo 'Reject';
						}
						?>
				</td>
				<td>{{$value->description}}</td>
				<td> 
					<a href="{{URL::to('/edit-product/'.$value->id_products)}}" class="btn btn-success">Edit</a>
					<a href="{{URL::to('/delete-product/'.$value->id_products)}}" class="btn btn-danger">Delete</a>
				</td>
			
            </tr>
			@endforeach
		</table>
		</div>
	</div>
</body>
</html>