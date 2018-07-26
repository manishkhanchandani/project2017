<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>    <?php
if(isset($_POST['number']) && $_POST['number']!='')  
    {    
        
        $number = $_POST[ 'number' ];      // get the number entered by user
       
        $temp = $number;
        $sum  = 0;
       
        while($temp != 0 )
        {
            $remainder   = $temp % 10; //find reminder
			echo "reminader is $remainder<br /><hr />";
            $sum         = $sum + ( $remainder * $remainder * $remainder ); 
			echo "sum is $sum<br /><hr />";
            $temp        = $temp / 10; 
			echo "temp2 is $temp<br /><hr />";
 
       }
        if( $number == $sum )
        {
            echo "$number is an Armstrong Number<br /><br />";
        }else
        {
            echo "$number is not an Armstrong Number<br /><br />";
        }
    }

?></p>

Write a program to find whether a number is Armstrong or not

Hide Answer

// If the sum of cubes of individual digits of a number is equal to the number itslef  then it is called Armstrong Number.

<form id="form1" name="form1" method="post" action="">
    <label>number
    <input type="text" name="number" />
    </label>
</form>
<p>&nbsp; </p>
</body>
</html>
