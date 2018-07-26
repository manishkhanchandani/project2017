<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST['rev2']))
{
         $rev=0;
         $num=$_POST['rev'];
           
echo "number is $num<br /><br />";
          while($num>=1)
                {
                  $re=$num%10;
echo "re is $re<br />";
                  $rev=$rev*10+$re;
echo "rev is $rev<br />";
                  $num=$num/10;
echo "num is $num<br /><hr />";
                 }
}
?>
<p>
Write a program to print Reverse of any number

</p>
    <table>
         <form name="frm" method="post">
            <tr><td>Number</td><td><input type="text" name="rev"></td></tr>
             <tr><td>Reverse is:</td><td><input type="text" value="<?php if(isset($_POST['rev2'])){echo $rev;} ?>" name="rev1"></td></tr>
             <tr><td> </td><td><input type="Submit" value="Reverse" name="rev2"></td></tr>
        </form>
    </table>

</body>
</html>
