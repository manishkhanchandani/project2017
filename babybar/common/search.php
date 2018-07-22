<?php
$sort = !empty($_GET['sort']) ? $_GET['sort'] : '3';
$sorttype = !empty($_GET['sorttype']) ? $_GET['sorttype'] : 'DESC';
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
		    <option value="1" <?php if (!(strcmp(1, $sort))) {echo "selected=\"selected\"";} ?>>Created Date</option>
		    <option value="2" <?php if (!(strcmp(2, $sort))) {echo "selected=\"selected\"";} ?>>Title</option>
		    <option value="3" <?php if (!(strcmp(3, $sort))) {echo "selected=\"selected\"";} ?>>ID</option>
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
	<button type="submit" class="btn btn-default">Search</button>
</form>