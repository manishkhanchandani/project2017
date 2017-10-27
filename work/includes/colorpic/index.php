<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" src="colorpicker.js"></script>
<script language="javascript">
function init(){
	var inp1 = document.getElementById('input1');
	var inp2 = document.getElementById('input2');
	var inp3 = document.getElementById('input3');
	var inp4 = document.getElementById('input4');

	if(inp1) attachColorPicker(inp1, true);
	if(inp2) attachColorPicker(inp2);
	if(inp3) attachColorPicker(inp3);
	if(inp4) attachColorPicker(inp4);
}

window.onload = init;
</script>
</head>

<body>
<h3>Demo</h3>
<fieldset>
<input id="input2" />
<input id="input3" />
<input id="input4" />
</fieldset>

</body>
</html>
