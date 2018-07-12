<form name="form1" method="get" action="">
	<h3>Search Practitioner</h3>
	<div class="form-group">
		<label for="keyword">Keyword: </label>
		<input type="text" class="form-control" id="keyword" name="keyword" placeholder="enter name or keyword" value="<?php echo !empty($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
	</div>
	<button type="submit" class="btn btn-default">Search</button>
</form>
<hr />