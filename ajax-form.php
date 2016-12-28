<html>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<style>
.good {color: green;}
.bad {color: red;}
#captcha {
-moz-user-select: none;
-khtml-user-select: none;
-webkit-user-select: none;
user-select: none;
}
</style>

	<?php
	function background($length = 6) {
	$characters = "ABCDEF0123456789";
	$string = "#";
	for ($p = 0; $p < $length; $p++) {
	$string .= $characters[mt_rand(0, strlen($characters) - 1)];}
	return $string;
	}
	$f = background();
	function signs($length = 6) {
	$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnoprstuvwxyz";
	$string = "";
	for ($p = 0; $p < $length; $p++) {
	$string .= $characters[mt_rand(0, strlen($characters) - 1)];}
	return $string;
	}
	$a = signs();
	?>

	<script>
	$(function() {       
	$("#refresh").click(function() { 
	$("#captcha").load(location.href + " #captcha");               
	});
	});   
	
	function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
	
	</script>
	
	<script>
	$(function()
	{  
		$("#send").click(function(evt)
		{
			var fname= $('#fname').val();
			var email= $('#email').val();			
			var msg= $('#msg').val();			
			
			
			if(fname =="" || email =="" || msg =="")
			{
				alert($('#fname').val());
				$("#error").html("<h3 class='bad'>Enter required fields*</h3>");
				evt.preventDefault();	
			}
			
			else if( !validateEmail(email))
			{ 
				$("#error").html("<h3 class='bad'>Enter valid email</h3>");
				evt.preventDefault();
			}
			
			else if ($('#check').val() !== $('#verify').val()) 
			{
				$("#error").html("<h3 class='bad'>Enter correct code</h3>");
				evt.preventDefault();
			} 
			else
			{		
				$("#result").html("<h3 class='good'>Success</h3>");
				evt.preventDefault();
			}
		});
	
	
	$("#contact").submit(function(e)
	{
		var url = "script.php"; 

			var fname= $('#fname').val();
			var email= $('#email').val();			
			var msg= $('#msg').val();	
			
			if(fname =="" || email =="" || msg =="")
			{
				$("#error").html("<h3 class='bad'>Enter required fields*</h3>");
				return false;
			}
			else if( !validateEmail(email))
			{ 
				$("#error").html("<h3 class='bad'>Enter valid email</h3>");
				return false;
			}
			else if ($('#check').val() !== $('#verify').val()) 
			{
				$("#error").html("<h3 class='bad'>Enter correct code</h3>");
				return false;
			}			
			else{
				
			$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#contact").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
					
				$("#contact").slideUp();		
				$("#error").html("<h3 class='good'>Sucessfully submitted</h3>");
				return false;
			   }
			});
			}
			e.preventDefault(); 
			});
});
	</script>
<head>

<h1>Captcha all in one</h1>
<hr />
</head>
<body>
	<form action="#" method="post" id="contact">
	
		<input type="text" id="fname" name="fname" placeholder="*Name">
		
		<input type="text" id="email" name="email" placeholder="*Email">
		
		<textarea id="msg" name="msg"></textarea>	
	
	
		<div id="captcha" style="height: 50px; width: 125px; background-color: <?php 	echo $f;   ?>">
			<font face="OCRB" style="font-size: xx-large;" color="<?php echo $a;  ?>">
				<p id="secimage"><?php echo $a; ?></p>
			</font>
			<input type="text" id="check" value="<?php echo $a; ?>" style="display: none;"/>
		</div>
		
		<button id="refresh">Refresh</button>	
		<input id="verify" type="text" placeholder="Enter code" />
		
		<input type="submit" id="sendd">
	
	</form>
		<div id="result"></div>
		<div id="error"></div>	
</body>
</html>