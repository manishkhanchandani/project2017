<?php
   $check=0;
if(isset($_POST['submit']) && $_POST['submit']=='Check' )
{ 
   $num=$_POST['number'];
   for($i=2;$i<=($num/2);$i++)
     { 
	 echo "i is $i, num is ".($num/2)." = ".($num%$i)."<br />";
       if($num%$i==0)
         {
          $check++;
          if($check==1)
          {
             break;
          }
         }
     }
}
?>
 <html>
   <head>
     <title>Prime Number</title>
   </head>
 <body>
  <table>
    <form name="frm" method="post" action="">
         <tr><td>Number:</td><td><input type="text" name="number" /></td></tr>
         <tr><td></td><td><input type="submit" name="submit" value="Check" /></td>
         <td>
          <center><span>
           <?php if(isset($_POST['number']))
           {if($check==0)
               {echo "It is a Prime Number";
               }
           else
                {
                 echo "It is not a Prime Number";}
                }
           ?>
          </span>
          </center>
         </td>
         </tr>
    </form>
  </table>
</body>
</html>