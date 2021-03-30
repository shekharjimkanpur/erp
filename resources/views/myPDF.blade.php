<!DOCTYPE html>
<html>
<head>
	<title>ERP Solution PDF </title>

	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</head>
<body>
	<!--<h1>{{ $title }}</h1>-->
<div class="table table-dark table-responsive border">
<table class="table table-responsive table-striped table-bordered">
<thead>
	<tr>
    	<td>Test Parameter</td>
    	<td>Observed value</td>
    	<td>Test method</td>
    </tr>
</thead>
<tbody id="TextBoxContainer">
@foreach ($arr1 as $value)
    <tr>
    <td><?php echo $value; ?></td>
    <td></td>
    <td></td>
    </tr>
@endforeach
</tbody>
</table>
</div>
</body>
</html>