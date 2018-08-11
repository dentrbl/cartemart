<?PHP // CRS LINK
	$link=mysqli_connect("localhost", "root", "", "inventory");
	
	// CHECK CONNECTION
	if (!$link)
		 die ("<script> alert('Error! Database connection failed.') </script>");
?>