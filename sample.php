<!DOCTYPE html>
<html>
<head>
	<title></title>
<style>
	#cont {display: none;}
	.show:focus + .hide {
		display: inline;
	}
	.show:focus + .hide +cont{
		display: block;
	}
</style>
</head>
<body>
	<div>
		<a href="#show" class="show">[Show]</a>
		<a href="#hide" class="hide">[Show]</a>

		<div id="cont">
			Hello
		</div>
	</div>
</body>
</html>