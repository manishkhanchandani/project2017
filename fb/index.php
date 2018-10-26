<?php require_once('../Connections/conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	include('../functions.php');
	$url = 'http://api.mkgalaxy.com/ip.php?ip='.$_SERVER['REMOTE_ADDR'];
	$data = curlget($url);
	$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
	$_POST['location'] = $data['output'];
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO fb_users (ip, fb_name, location, is_av, education_prof, like_movie) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ip'], "text"),
                       GetSQLValueString($_POST['fb_name'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['is_av'], "int"),
                       GetSQLValueString($_POST['education_prof'], "text"),
                       GetSQLValueString($_POST['like_movie'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "confirm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FB User </title>
<style type="text/css">
<!--
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<h1>FB User </h1>
<iframe width="560" height="315" src="https://www.youtube.com/embed/dv3TeRcDMPI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<br /><br /><br /><br />
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Do you believe in above movie?</strong> </td>
            <td valign="top"><table>
                <tr>
                    <td><input type="radio" name="like_movie" value="1">
                        Yes</td>
                </tr>
                <tr>
                    <td><input type="radio" name="like_movie" value="0">
                        No</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Your Facebook Name:</strong></td>
            <td valign="top"><input type="text" name="fb_name" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap><strong>Are you AV or PV:</strong></td>
            <td valign="top"><table>
                <tr>
                    <td><input type="radio" name="is_av" value="1" >
                        AV</td>
                </tr>
                <tr>
                    <td><input type="radio" name="is_av" value="0" >
                        PV</td>
                </tr>
            </table></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right" valign="top"><strong>Education / Profession:</strong></td>
            <td valign="top"><textarea name="education_prof" cols="50" rows="5"></textarea>            </td>
        </tr>
        <tr valign="baseline">
            <td align="right" valign="top" nowrap>&nbsp;</td>
            <td valign="top"><input type="submit" value="Insert record"></td>
        </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
