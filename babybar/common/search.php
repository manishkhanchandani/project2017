<?php
$sort = !empty($_GET['sort']) ? $_GET['sort'] : (!empty($_COOKIE['sort']) ? $_COOKIE['sort'] : 'id');
$sorttype = !empty($_GET['sorttype']) ? $_GET['sorttype'] : (!empty($_COOKIE['sorttype']) ? $_COOKIE['sorttype'] : 'DESC');
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
	<input name="my" type="hidden" value="<?php echo !empty($_GET['my']) ? $_GET['my'] : ''; ?>" />
	<button type="submit" class="btn btn-default">Search</button>
</form>