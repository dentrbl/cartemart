<?php
	require ('inventorylink.php');
	session_start();
	require ('authentication.php');
	$uname=$_SESSION["uname"];
	include('navbar.php');
	$prod_query=mysqli_query($link, "SELECT prodname, proddesc, netweight, prodprice, stock, image
	FROM products");
	$avail=" ";
	$prodno=mysqli_num_rows($prod_query);
	if($prodno > 0){
		echo("
			<table>
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Product Description</th>
						<th>Net Weight</th>
						<th>Price</th>
						<th>Availability</th>
						<th>Image</th>
					</tr>
				</thead>
				<tbody>
		");
		while($prec=mysqli_fetch_row($prod_query)){
			if($prec[4]>0)
				$avail='Available';
			else
				$avail='Not Available';
			echo("
					<tr>
						<td>$prec[0]</td>
						<td>$prec[1]</td>
						<td>$prec[2]</td>
						<td>$prec[3]</td>
						<td>$avail</td>
						<td><img src='$prec[5]' style='height:150px; width:150px;'></td>
					</tr>
			");
		}
		echo("
				</tbody>
			</table>
		");
	}
?>
	</body>
</html>
