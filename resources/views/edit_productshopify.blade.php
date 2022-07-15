<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	

<div class="container my-4">
	<div class="row justify-content-center">
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header bg-success text-white font-weight-bold">Add Products</div>
                @foreach ($editProducts as $item => $value)
                    
               
				<form action="{{URL::to('/update-product/'.$value->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
					<div class="form-group">
						<label>ID</label>
						<input type="text" name="id_product" class="form-control" value="{{ $value->id}}">
					</div>

					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" value="{{ $value->title}}">
					</div>

					<div class="form-group">
						<label>Description</label>
						<input type="text" name="body_html" class="form-control" value="{{ $value->body_html}}">
					</div>

					<div class="form-group">
						<label>Image</label>
						<input type="file" name="image" class="form-control-file" value="">
					</div>

					<div class="form-group">
						<input type="submit" name="update_Product" class="btn btn-success" value="Update">
					</div>
				</form>
                @endforeach
			</div>
		</div>
	</div>
</div>

</body>
</html>