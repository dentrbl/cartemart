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
	$ulistquery=mysqli_query($link,"SELECT dateupdated, budget, totalprice
	FROM userlist
	WHERE prodlistid=".$_GET["prodlistid"]." AND userid='$uidf[0]'");
	$ulist=mysqli_fetch_row($ulistquery);
	$plistquery=$db_handle->runQuery("SELECT pl.productid, prodname, pl.quantity, prodprice
	FROM prodlist AS pl
	JOIN products AS pd ON pd.productid=pl.productid
	JOIN userlist AS ul ON ul.prodlistid=pl.prodlistid
	WHERE ul.prodlistid=".$_GET["prodlistid"]." AND ul.userid='$uidf[0]'");
	if(!empty($plistquery)){
?>
		<table>
			<thead>
				<tr>
					<td>Date Created/Updated</td>
					<td><?php echo $ulist[0];?></td>
				</tr>
				<tr>
					<td>Budget</td>
					<td><?php echo $ulist[1];?></td>
				</tr>
				<tr>
					<td>Product</td>
					<td>Quantity</td>
					<td>Price</td>
					<td>Total</td>
				</tr>
			</thead>
			<tbody>
<?php
		foreach($plistquery as $key=>$value){
?>
				<tr>
					<td><?php echo $plistquery[$key]['prodname']; ?></td>
					<td><?php echo $plistquery[$key]['quantity']; ?></td>
					<td><?php echo $plistquery[$key]['prodprice']; ?></td>
					<td><?php echo number_format($plistquery[$key]['quantity']*$plistquery[$key]['prodprice'],2,'.',''); ?></td>
				</tr>
<?php
		}
?>
				<tr>
					<td colspan='3'>Total Price:</td>
					<td><?php echo $ulist[2];?><td>
				</tr>
			</tbody>
		</table>
<?php
	}
?>
	</body>
</html>