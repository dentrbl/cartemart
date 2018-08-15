<?php
	require ('inventorylink.php');
	session_start();
	require ('authentication.php');
	$uname=$_SESSION["uname"];
	$uidquery=mysqli_query($link,"select userid from users where uname='$uname'");
	$uidf=mysqli_fetch_row($uidquery);
	require_once ('dbconnect.php');
	$db_handle = new DBController();
	include('navbar.php');
	if(!empty($_GET["action"])){
		switch($_GET["action"]){
			case "budget":
				$_SESSION["budget"]=$_POST["bamount"];
			break;
			
			case "add":
				if(!empty($_POST["quantity"])){
					$product = $db_handle->runQuery("SELECT * FROM products WHERE productid='" . $_GET["productid"] . "'");
					$itemArray = array($product[0]["productid"]=>array('prodname'=>$product[0]["prodname"], 'productid'=>$product[0]["productid"], 'quantity'=>$_POST["quantity"], 'prodprice'=>$product[0]["prodprice"]));
					if(!empty($_SESSION["slist"])){
						if(in_array($product[0]["productid"],array_keys($_SESSION["slist"]))){
							foreach($_SESSION["slist"] as $k => $v){
								if($product[0]["productid"] == $k){
									if(empty($_SESSION["slist"][$k]["quantity"])){
										$_SESSION["slist"][$k]["quantity"] = 0;
									}
									$_SESSION["slist"][$k]["quantity"] += $_POST["quantity"];
								}
							}
						}
						else{
							$_SESSION["slist"] = array_merge($_SESSION["slist"],$itemArray);
						}
					}
					else{
						$_SESSION["slist"] = $itemArray;
					}
				}
				else
					echo ("<script> alert('No quantity entered. Please put the quantity in order to add to the list.'); </script>");
			break;
			
			case "remove":
				if(!empty($_SESSION["slist"])){
					foreach($_SESSION["slist"] as $k => $v){
						if($_GET["productid"] == $k)
							unset($_SESSION["slist"][$k]);
						if(empty($_SESSION["slist"]))
							unset($_SESSION["slist"]);
					}
				}
			break;
			
			case "empty":
				unset($_SESSION["slist"]);
			break;
			
			case "finalize":
				$finalize=mysqli_query($link,"INSERT INTO userlist(userid,budget,totalprice,status) VALUES('$uidf[0]','".$_SESSION['budget']."','".$_SESSION["item_total"]."','1')");
				$id_query=mysqli_query($link, "SELECT prodlistid FROM userlist WHERE userid='$uidf[0]' ORDER BY dateadded DESC LIMIT 1");
				$plistid=mysqli_fetch_row($id_query);
				foreach($_SESSION["slist"] as $k => $v){
					$addproducts=mysqli_query($link,"INSERT INTO prodlist(prodlistid,productid,quantity) VALUES('$plistid[0]','".$_SESSION['slist'][$k]['productid']."','".$_SESSION['slist'][$k]['quantity']."')");
				}
				echo ("<script> alert('Shopping list has been created. To view or edit the list created, go to shopping list tab.'); </script>");
				unset($_SESSION["slist"]);
				$_SESSION["budget"]=0;
				$_SESSION["cid"]=0;
				$_SESSION["scid"]=0;
			break;
			
			case "filter":
				$_SESSION["cid"]=$_POST["category"];
				$_SESSION["scid"]=$_POST["subcat"];
			break;
		}
	}
?>
		<form method="post" action="createslist.php?action=budget">
			Budget:<br />
			<input type='number' step='0.01' placeholder='amount' name='bamount' required><input type="submit" name='budget' value="Place Budget"/>
			<!--Estimated Date of Grocery Shopping:<br />
			<input type='date' name='dateofbuying' placeholder='Estimated Date of Buying'>-->
		</form>
		Shopping List <br />
		<a id="btnEmpty" href="createslist.php?action=empty">Empty List</a>
		<?php
			//??? I have a wild guess but not sure if guess is correct hehez
			if(isset($_SESSION["slist"])){
				$_SESSION["item_total"] = 0;
				$item_tot = 0;
		?>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($_SESSION["slist"] as $item){
				?>
				<tr>
					<td><?php echo $item["prodname"]; ?></td>
					<td><?php echo $item["quantity"]; ?></td>
					<td><?php echo "$".$item["prodprice"]; ?></td>
					<td><a href="createslist.php?action=remove&productid=<?php echo $item["productid"]; ?>">Remove Item</a></td>
				</tr>
				<?php
					$_SESSION["item_total"] += ($item["prodprice"]*$item["quantity"]);
					$item_tot += $item["quantity"];
				}
				?>
				<tr>
					<td colspan="4" align=right><strong>Total:</strong> <?php echo "Php ". number_format($_SESSION["item_total"],2,'.',''); ?></td>
				</tr>
				<tr>
					<td colspan="4" align=right><strong>Total Items:</strong> <?php echo $item_tot; ?></td>
				</tr>
				<tr>
					<td colspan="4" align=right><a href="createslist.php?action=finalize">Finalize</a></td>
				</tr>
			</tbody>
		</table>
		<?php
			}
		?>
		<br /><br />
		<?php
			if($_SESSION["budget"]>0){
			$catquery=mysqli_query($link,"SELECT * FROM categories");
			$subcatquery=mysqli_query($link,"SELECT subcatid, subcatname FROM subcategories");
		?>
		<form method="post" action="createslist.php?action=filter">
			<select name='category' title="category">
				<option selected disabled>- Select Category -</option>
				<?php 
					while($cat=mysqli_fetch_row($catquery)){
						echo("<option value='$cat[0]'>$cat[1]</option>");
					}
				?>
			</select>
			<select name='subcat' title="subcategory">
				<option selected disabled>- Select Subcategory -</option>
				<?php 
					while($subcat=mysqli_fetch_row($subcatquery)){
						echo("<option value='$subcat[0]'>$subcat[1]</option>");
					}
				?>
			</select>
			<input type="submit" value="Filter"/>
		</form><br />
		Budget: Php <?php echo number_format($_SESSION["budget"],2,'.',''); ?><br />
		<table>
			<tbody>
				<?php
					$cbudget=$_SESSION["budget"]-$_SESSION["item_total"];
					echo("<html>Remaining Money: ".number_format($cbudget,2,'.','')."<br />Products:</html>");
					if(!empty($_SESSION["cid"]) and !empty($_SESSION["scid"])){
						$product_array = $db_handle->runQuery("SELECT *
						FROM products
						WHERE STATUS=1 AND stock>0 AND reserved<stock AND prodprice<=".$cbudget." AND categoryid=".$_SESSION["cid"]." AND subcatid=".$_SESSION["scid"]."
						ORDER BY categoryid, subcatid, productid ASC");
					}
					else{
						$product_array = $db_handle->runQuery("SELECT *
						FROM products
						WHERE STATUS=1 AND stock>0 AND reserved<stock AND prodprice<=".$cbudget."
						ORDER BY categoryid, subcatid, productid ASC");
					}
					if (!empty($product_array)){
						foreach($product_array as $key=>$value){
				?>
				<form method="post" action="createslist.php?action=add&productid=<?php echo $product_array[$key]["productid"]; ?>">
					<tr>
						<td><img src="<?php echo $product_array[$key]["image"]; ?>" style="height:150px; width:150px;"></td>
						<td><?php echo $product_array[$key]["prodname"]; ?></td>
						<td><?php echo "Php ".$product_array[$key]["prodprice"]; ?></td>
						<td><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to Shopping List" /></td>
					</tr>
				</form>
				<?php
							}
						}
					}
				?>
			</tbody>
		</table>
		</form>
	</body>
</html>
