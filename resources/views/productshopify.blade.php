<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	
	<link rel="stylesheet" href="/products/resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../resources/css/mystyle.css">
</head>
<body>
	<h1>Products list</h1>
		<table style=" border: black 1px solid; text-align: center;">
			<tr style="background: #867979;">
				
				<th width="10%">Title</th>
				<th width="20%">Description</th>
				<th width="20%">Image</th>
				<td width="">Action</td>
			</tr>
			@foreach ($getProducts  as $item => $value)
			<tr>
				<td>{{$value->title}}</td>
				<td>{{$value->body_html}}</td>
				<td>{{$value->image}}</td>
				<td> 
					<a href="/editproduct" class="btn btn-success">Edit</a>
					<a href="{{URL::to('/delete-product/'.$value->id)}}" class="btn btn-danger">Delete</a>
				</td>
            </tr>
			
			@endforeach
		</table>
	</body>
</html>