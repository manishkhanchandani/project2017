
$(document).on("keypress", 'form', function (e) {
  var code = e.keyCode || e.which;
  if (code == 13) {
	  var str = e.target.className;
	  var n = str.indexOf("addressBox");
	  if (n === -1) {
		return true;
	  } else {
		return false;
	  }
	  return true;
  }
});