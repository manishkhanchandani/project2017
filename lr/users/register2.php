<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div class="row">
<div class="col-md-12">
<h3>Register Page</h3>
<form name="formRegister" id="formRegister" action="">
<div class="form-group">
<label for="email">Email address</label>
<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
</div>
<div class="form-group">
<label for="cpassword">Confirm Password</label>
<input type="password" class="form-control" id="cpassword" placeholder="Confirm Password">
</div>
<div class="form-group">
<label for="first_name">First Name</label>
<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
</div>
<div class="form-group">
<label for="last_name">Last Name</label>
<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
</div>
<div class="form-group">
<label for="birth_year">Birth Year</label>
<input type="number" class="form-control" name="birth_year"id="birth_year" placeholder="Enter Birth Year">
    
</div>
  
<div class="form-group">
<label for="gender">Gender</label>
<div class="radio">
<label>
<input type="radio" name="gender" id="gender_male" value="male" checked>
    Male
</label>
<label>
<input type="radio" name="gender" id="gender_female" value="female">
    Female
</label>
</div></div>

<div class="checkbox">
<label>
<input type="checkbox" id="terms" > I accept the terms and conditions
</label>
</div>
  
<input name="created_dt" type="hidden" value="<?php echo date("Y-m-d H-i-s"); ?>">
<input name="login_dt" type="hidden" value="<?php echo time(); ?>">
<button type="submit" class="btn btn-default">Register</button>
</form>
</div>
  
  
  
  
  
  
</div>
</body>
</html>
