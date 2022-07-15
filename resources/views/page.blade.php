<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/shopify" method="get">
        {{ csrf_field()}}
        <div>
            Name store shopify
			<input type="text" name="name" id="name">
			<button class="btn btn-info" type="submit">Search</button>
        </div>
    </form>
</body>
</html>