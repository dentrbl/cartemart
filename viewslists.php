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
	$_SESSION["budget"]=0; $_SESSION["item_total"] = 0;
	if(!empty($_GET["action"])){
		switch($_GET["action"]){
			case "remove":
				$ustatus=mysqli_query($link,"UPDATE userlist SET STATUS=0 WHERE prodlistid=".$_GET["prodlistid"]."");
			break;
		}
	}
?>
		<a href="createslist.php">Add Shopping List</a><br />
		<table>
			<thead>
				<tr><th colspan='5'>Pending Shopping Lists</th></tr>
				<tr>
					<td>Date Created/Updated</td>
					<td>Budget Alloted</td>
					<td>Total Price</td>
					<td>Action</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$getall=$db_handle->runQuery("SELECT prodlistid, dateupdated, budget, totalprice
					FROM userlist
					WHERE userid='$uidf[0]' AND STATUS=1
					ORDER BY dateupdated DESC");
					if(!empty($getall)){
						foreach($getall as $key=>$value){
				?>
				<tr>
					<td><?php echo $getall[$key]["dateupdated"]; ?></td>
					<td><?php echo number_format($getall[$key]["budget"],2,'.',''); ?></td>
					<td><?php echo number_format($getall[$key]["totalprice"],2,'.',''); ?></td>
					<td><a href="editlist.php?prodlistid=<?php echo $getall[$key]["prodlistid"]; ?>">Edit List</a></td>
					<td><a href="viewslists.php?action=remove&prodlistid=<?php echo $getall[$key]["prodlistid"]; ?>">Remove List</a></td>
				</tr>
				<?php
						}
					}
					else{
						echo("<html>
							<tr>
								<td colspan='5'>Nothing to show.</td>
							</tr>
						</html>");
					}
				?>
			</tbody>
		</table>
		<table>
			<thead>
				<tr><th colspan='4'>Shopping Lists</th></tr>
				<tr>
					<td>Date Created/Updated</td>
					<td>Budget Alloted</td>
					<td>Total Price</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$getall=$db_handle->runQuery("SELECT prodlistid, dateupdated, budget, totalprice
					FROM userlist
					WHERE userid='$uidf[0]'
					ORDER BY dateupdated DESC");
					if(!empty($getall)){
						foreach($getall as $key=>$value){
				?>
				<tr>
					<td><?php echo $getall[$key]["dateupdated"]; ?></td>
					<td><?php echo number_format($getall[$key]["budget"],2,'.',''); ?></td>
					<td><?php echo number_format($getall[$key]["totalprice"],2,'.',''); ?></td>
					<td><a href="Showlist.php?prodlistid=<?php echo $getall[$key]["prodlistid"]; ?>">View List</a></td>
				</tr>
				<?php
						}
					}
					else{
						echo("<html>
							<tr>
								<td colspan='4'>Nothing to show.</td>
							</tr>
						</html>");
					}
				?>
			</tbody>
		</table>
	</body>
</html>