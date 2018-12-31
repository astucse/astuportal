<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
</head>
<body>

<?=$content?>

<footer style="background: gray; color: white">
	<h5>Signed by:
	@foreach($people as $p) 
	{{$p->name}}  ,
	@endforeach
	</h5>
</footer>
</body>
</html>