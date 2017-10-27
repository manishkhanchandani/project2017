<?php
include 'include.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="get" action="">
	Dates: 
	<label for="dates"></label>
	<select name="dates" id="dates">
	<option value="">Select</option>
	<?php foreach($dirs as $key => $dir) { ?>
	<option value="<?php echo $key; ?>"><?php echo $dir; ?></option>
	<?php } ?>
	</select>
	<input type="submit" name="button" id="button" value="Submit" />
</form>
<?php if(!empty($records)) { ?>
<p>Records</p>
<table width="100%" border="1" cellpadding="5" cellspacing="1">
	<tr>
		<td>Title</td>
		<td>Description</td>
		<td>Link</td>
	</tr>
	<?php foreach ($records as $record) { ?>
	<tr>
		<td><?php echo $record['title']; ?>&nbsp;</td>
		<td><?php echo $record['description']; ?>&nbsp;</td>
		<td><a href="<?php echo $record['link']; ?>" target="_blank">Link</a>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><?php foreach ($record['images'] as $images) { ?>
			<img src="<?php echo $images; ?>" /> 
		<?php } ?></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>