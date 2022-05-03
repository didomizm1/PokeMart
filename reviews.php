<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reviews System</title>
	<link rel="stylesheet"type="text/css"href="style.css">
	<link rel="stylesheet"type="text/css"href="reviews.css">

</head>
<body>
	<nav class="navtop">
		<div>
			<h1>Pokemart Ratings and Reviews</h1>
		</div>
	</nav>
	<div class="content home">
		<h2>Add Review To Your Website</h2>
		<p>Check out the below reviews for Pokemart.</p>
		<div class="reviews"></div>
		<script src="reviews.js"></script>

		<script>
			new reviews({
				page_id: 1,
				reviews_per_pagination_page: 5,
				current_pagination_page: 1
			});
		</script>
	</div>
</body>
</html>
