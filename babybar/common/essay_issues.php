<?php require_once('../../Connections/conn.php'); ?>
<?php

if (!empty($_GET['deleted_id'])) {
	$date = date('Y-m-d H:i:s');
	$deleteSQL = sprintf("UPDATE calbabybar_nodes SET deleted = 1, deleted_dt = %s WHERE id=%s AND user_id=%s",
                       GetSQLValueString($date, "date"),
                       GetSQLValueString($_GET['deleted_id'], "int"),
					   GetSQLValueString($_SESSION['MM_UserId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && !empty($_SESSION['MM_UserId'])) {
  $insertSQL = sprintf("INSERT INTO calbabybar_nodes (user_id, subject_id, title, node_type, sub_topic, related_id) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['MM_UserId'], "int"),
                       GetSQLValueString($_POST['subject_id'], "int"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['node_type'], "text"),
                       GetSQLValueString($_POST['sub_topic'], "text"),
                       GetSQLValueString($_POST['related_id'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$coldetailid_rsMyEssayIssues = "-1";
if (isset($_GET['detail_id'])) {
  $coldetailid_rsMyEssayIssues = (get_magic_quotes_gpc()) ? $_GET['detail_id'] : addslashes($_GET['detail_id']);
}
$colname_rsMyEssayIssues = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_rsMyEssayIssues = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
mysql_select_db($database_conn, $conn);
$query_rsMyEssayIssues = sprintf("SELECT * FROM calbabybar_nodes WHERE user_id = %s AND node_type = 'essay_issues' AND related_id = %s AND deleted = 0 ORDER BY id ASC", $colname_rsMyEssayIssues,$coldetailid_rsMyEssayIssues);
$rsMyEssayIssues = mysql_query($query_rsMyEssayIssues, $conn) or die(mysql_error());
$row_rsMyEssayIssues = mysql_fetch_assoc($rsMyEssayIssues);
$totalRows_rsMyEssayIssues = mysql_num_rows($rsMyEssayIssues);

$coluser_rsEditEssayIssue = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $coluser_rsEditEssayIssue = (get_magic_quotes_gpc()) ? $_SESSION['MM_UserId'] : addslashes($_SESSION['MM_UserId']);
}
$colname_rsEditEssayIssue = "-1";
if (isset($_GET['update_id'])) {
  $colname_rsEditEssayIssue = (get_magic_quotes_gpc()) ? $_GET['update_id'] : addslashes($_GET['update_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEditEssayIssue = sprintf("SELECT * FROM calbabybar_nodes WHERE id = %s AND user_id = %s", $colname_rsEditEssayIssue,$coluser_rsEditEssayIssue);
$rsEditEssayIssue = mysql_query($query_rsEditEssayIssue, $conn) or die(mysql_error());
$row_rsEditEssayIssue = mysql_fetch_assoc($rsEditEssayIssue);
$totalRows_rsEditEssayIssue = mysql_num_rows($rsEditEssayIssue);

$xtras = array();
if ($totalRows_rsEditEssayIssue) {
	$xtras = $row_rsEditEssayIssue['xtras'];
	$xtras = json_decode($xtras, 1);
}

if (!isset($xtras['copying'])) {
	$xtras['copying'] = 1;
}

?>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-header">List All Issues</h3>
		<form method="post" name="formAdd">
			<div class="form-group">
				<label for="currency_type">Issue:</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Add New Issue" value="" />
			</div>
			<div class="form-group">
				<input type="submit" value="Add New Issue">
				<input type="hidden" name="MM_insert" value="form1" />
				  <input type="hidden" name="user_id" value="<?php echo $_SESSION['MM_UserId']; ?>">
				  <input type="hidden" name="subject_id" value="<?php echo $id; ?>">
				<input type="hidden" name="node_type" value="essay_issues" />
				<input type="hidden" name="related_id" value="<?php echo $detail_id; ?>" />
				<input type="hidden" name="sub_topic" value="Issues" />
			</div>
		</form>
		<?php if ($totalRows_rsEditEssayIssue > 0) { ?>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquerycountdown/jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_PATH; ?>js/jquerycountdown/jquery.countdownTimer.css" />

		<a name="edit"></a>
<h3>Edit Issue</h3>
<?php

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && !empty($_SESSION['MM_UserId'])) {
	$xtras['timer'] = $_POST['timer'];
	$xtras['copying'] = $_POST['copying'];
	$xtras2 = json_encode($xtras);
	$insertSQL = sprintf("UPDATE calbabybar_nodes set title=%s, description=%s, xtras=%s WHERE id=%s AND user_id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($xtras2, "text"),
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_SESSION['MM_UserId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
  echo '<div class="alert alert-warning">Form Updated, Refreshing....<meta http-equiv="refresh" content="1;URL='.$detailUrl.'"></div>';
  

}
?>
		<form method="post" name="formEdit" onSubmit="return callme();">
			<div>
				<input id="pauseBtnhms" type="button" value="pause">&nbsp;&nbsp;<input type="button" id="stopBtnhms" value="start">&nbsp;&nbsp;
				<span id="s_timer"></span><br/><br/><br/></div>
			<div class="form-group">
				<label for="currency_type">Issue Title:</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Issue" value="<?php echo $row_rsEditEssayIssue['title']; ?>" />
			</div>
			<div class="form-group">
				<label for="copying">Copying</label>
				<select name="copying" id="copying" class="form-control">
				    <option value="1" <?php if (!(strcmp(1, $xtras['copying']))) {echo "selected=\"selected\"";} ?>>Copying</option>
				    <option value="0" <?php if (!(strcmp(0, $xtras['copying']))) {echo "selected=\"selected\"";} ?>>Writing Without Looking</option>
				</select>  
			</div>	
			<div class="form-group">
				<label for="description">Description:</label>
				<textarea class="form-control" id="description" rows="5" name="description"><?php echo (!empty($row_rsEditEssayIssue['description'])) ? $row_rsEditEssayIssue['description'] : ''; ?></textarea>
			</div> 
			<div class="form-group">
				<input type="submit" value="Update Issue">
				<input type="hidden" value="" id="timer" name="timer">
				<input type="hidden" name="MM_update" value="form1" />
				<input type="hidden" name="id" value="<?php echo $row_rsEditEssayIssue['id']; ?>" />
			</div>
			<script>
				function callme() {
					document.getElementById('timer').value = parseInt(document.getElementById('s_timer').innerHTML);
					return true;
				}
			</script>
			
			<script>
				$(function(){
					$('#s_timer').countdowntimer({
						seconds :<?php echo (!empty($xtras['timer'])) ? $xtras['timer'] : 11; ?>,
						size : "xs",
						reverseDir: true,
						pauseButton : "pauseBtnhms",
						stopButton : "stopBtnhms",
						stopInitially: true
					});
				});
			</script>
		</form>
		<?php }?>
	</div>
	
	<div class="col-md-12">
		<?php if ($totalRows_rsMyEssayIssues > 0) { // Show if recordset not empty ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">My Issues</h3>
				</div>
				<div class="panel-body">
					<?php $totalTime = 0; ?>
					<?php do { ?>
					<?php 
						$xtrasEdit = $row_rsMyEssayIssues['xtras'];
						$xtrasEdit = json_decode($xtrasEdit, 1);
						if (empty($xtrasEdit)) {
							$xtrasEdit['copying'] = 1;
							$xtrasEdit['timer'] = 0;
						}
						$totalTime = $totalTime + $xtrasEdit['timer'];
					?>
					<div><a href=""><?php echo $row_rsMyEssayIssues['title']; ?></a> (<?php echo floor($xtrasEdit['timer'] / 60); ?> mins) <span class=""><a href="<?php echo $detailUrl.'?update_id='.$row_rsMyEssayIssues['id']; ?>#edit"><img src="<?php echo HTTP_PATH; ?>images/edit16.png" /></a> <a href="<?php echo $detailUrl.'?deleted_id='.$row_rsMyEssayIssues['id']; ?>" onClick="var a = confirm('do you really want to delete this record?'); return a;"><img src="<?php echo HTTP_PATH; ?>images/delete16.png" /></a></span></div>
					<?php } while ($row_rsMyEssayIssues = mysql_fetch_assoc($rsMyEssayIssues)); ?>
					<div>Total Time: <?php echo floor($totalTime / 60); ?> mins</div>
				</div>
			</div>
		<?php } // Show if recordset not empty ?>
           
	</div>
</div>

<?php
mysql_free_result($rsMyEssayIssues);

mysql_free_result($rsEditEssayIssue);
?>
