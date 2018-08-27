<?php
$sort = !empty($_GET['sort']) ? $_GET['sort'] : (!empty($_COOKIE['sort']) ? $_COOKIE['sort'] : 'id');
$sorttype = !empty($_GET['sorttype']) ? $_GET['sorttype'] : (!empty($_COOKIE['sorttype']) ? $_COOKIE['sorttype'] : 'DESC');
$sub_topic = !empty($_GET['sub_topic']) ? $_GET['sub_topic'] : '%';
$title = !empty($_GET['title']) ? $_GET['title'] : '%';


$sql2 = '';

if (empty($_SESSION['MM_UserId'])) {
	$sql2 .= " AND status = 1";
} else {
	$sql2 .= sprintf(" AND (status = 1 OR (status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}

if (empty($_SESSION['MM_UserId'])) {
	$sql2 .= " AND current_status = 1";
} else {
	$sql2 .= sprintf(" AND (current_status = 1 OR (current_status = 0 AND user_id=%s))", $_SESSION['MM_UserId']);
}


$colname_rsDistinctTitle = "-1";
if (isset($_GET['id'])) {
  $colname_rsDistinctTitle = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsDistinctTitle = sprintf("SELECT DISTINCT title, sub_topic FROM calbabybar_nodes WHERE subject_id = %s AND node_type = '%s' $sql2 AND deleted = 0 ORDER BY sub_topic ASC, title ASC", $colname_rsDistinctTitle, $node_type);
$rsDistinctTitle = mysql_query($query_rsDistinctTitle, $conn) or die(mysql_error());
$row_rsDistinctTitle = mysql_fetch_assoc($rsDistinctTitle);
$totalRows_rsDistinctTitle = mysql_num_rows($rsDistinctTitle);


$colname_rsDistinctSubtopic = "-1";
if (isset($_GET['id'])) {
  $colname_rsDistinctSubtopic = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn, $conn);
$query_rsDistinctSubtopic = sprintf("SELECT DISTINCT sub_topic FROM calbabybar_nodes WHERE subject_id = %s AND node_type = '%s' $sql2 AND deleted = 0 ORDER BY sub_topic ASC", $colname_rsDistinctSubtopic, $node_type);
$rsDistinctSubtopic = mysql_query($query_rsDistinctSubtopic, $conn) or die(mysql_error());
$row_rsDistinctSubtopic = mysql_fetch_assoc($rsDistinctSubtopic);
$totalRows_rsDistinctSubtopic = mysql_num_rows($rsDistinctSubtopic);
?>
<form name="form1" method="get" action="">
	<h3>Search</h3>
	<div class="form-group">
		<label for="keyword">Keyword: </label>
		<input type="search" class="form-control" id="keyword" name="keyword" placeholder="enter name or keyword" value="<?php echo !empty($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
	</div>
	<div class="form-group">
		<label for="sort">Sorting: </label>
		<select name="sort" id="sort" class="form-control">
		    <option value="" <?php if (!(strcmp("", $sort))) {echo "selected=\"selected\"";} ?>>Select</option>
		    <option value="topic_created" <?php if (!(strcmp("topic_created", $sort))) {echo "selected=\"selected\"";} ?>>Created Date</option>
		    <option value="title" <?php if (!(strcmp("title", $sort))) {echo "selected=\"selected\"";} ?>>Title</option>
		    <option value="id" <?php if (!(strcmp("id", $sort))) {echo "selected=\"selected\"";} ?>>ID</option>
		    <option value="4" <?php if (!(strcmp(4, $sort))) {echo "selected=\"selected\"";} ?>>Subtopic, ID</option>
		    <option value="5" <?php if (!(strcmp(5, $sort))) {echo "selected=\"selected\"";} ?>>Subtopic, Title</option>
        </select>
	</div>
	<div class="form-group">
		<label for="sorttype">Sorting Type: </label>
		<select name="sorttype" id="sorttype" class="form-control">
		    <option value="" <?php if (!(strcmp("", $sorttype))) {echo "selected=\"selected\"";} ?>>Select</option>
		    <option value="ASC" <?php if (!(strcmp("ASC", $sorttype))) {echo "selected=\"selected\"";} ?>>ASC</option>
		    <option value="DESC" <?php if (!(strcmp("DESC", $sorttype))) {echo "selected=\"selected\"";} ?>>DESC</option>
        </select>
	</div>
	<div class="form-group">
		<label for="sorttype">SubTopic: </label>
		<select name="sub_topic" id="sub_topic" class="form-control">
                          <option value="%">Select Sub Topic</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_rsDistinctSubtopic['sub_topic']?>" <?php if ($sub_topic === $row_rsDistinctSubtopic['sub_topic']) { ?>selected="selected"<?php } ?> ><?php echo $row_rsDistinctSubtopic['sub_topic']?></option>
                          <?php
} while ($row_rsDistinctSubtopic = mysql_fetch_assoc($rsDistinctSubtopic));
  $rows = mysql_num_rows($rsDistinctSubtopic);
  if($rows > 0) {
      mysql_data_seek($rsDistinctSubtopic, 0);
	  $row_rsDistinctSubtopic = mysql_fetch_assoc($rsDistinctSubtopic);
  }
?>
                      </select>
	</div>
	
	<div class="form-group">
		<label for="sorttype">Title: </label>
		<select name="title" id="title" class="form-control">
                          <option value="%">Select Title</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_rsDistinctTitle['title']?>"<?php if ($title === $row_rsDistinctTitle['title']) { ?>selected="selected"<?php } ?> ><?php echo $row_rsDistinctTitle['title']?> (<?php echo $row_rsDistinctTitle['sub_topic']?>)</option>
                          <?php
} while ($row_rsDistinctTitle = mysql_fetch_assoc($rsDistinctTitle));
  $rows = mysql_num_rows($rsDistinctTitle);
  if($rows > 0) {
      mysql_data_seek($rsDistinctTitle, 0);
	  $row_rsDistinctTitle = mysql_fetch_assoc($rsDistinctTitle);
  }
?>
                      </select>
	</div>
	<input name="my" type="hidden" value="<?php echo !empty($_GET['my']) ? $_GET['my'] : ''; ?>" />
	<button type="submit" class="btn btn-default">Search</button>
</form>
<?php
mysql_free_result($rsDistinctTitle);

mysql_free_result($rsDistinctSubtopic);
?>
