<?php
	session_start();
	if(!isset($_SESSION['username']))
		header('Location: http://localhost/IITH-Course-Schedule/UI/index.php');
	
?>
<!DOCTYPE html>
<html>
<head>
<title>IITH | Home</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
<link href="css/style-index.css" rel="stylesheet" type="text/css" media="all"/>

<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300,400,500,600,700,900' rel='stylesheet' type='text/css'>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Jalil Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"> </script>

<!---- start-smoth-scrolling---->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
		});
	});
</script>
 <!---- end-smoth-scrolling---->

</head>
<body>
<!--body-->
<div id="home" class="banner">
	 <div class="container">
		 <div class="top-header">		  
				<div class="logo">
					<a href="www.iith.ac.in"><img src="images/logo2.png" alt="" /></a>
				</div>
			  <div class="top-menu">
					<span class="menu"> </span>
				  <ul>
				      <nav class="cl-effect-5">
							<li><a class="active scroll" href="http://www.iith.ac.in" target="_blank"><span data-hover="Home">Home</span></a></li> 
							<li>/</li>
							<li><a class="scroll" href="http://localhost/IITH-Course-Schedule/UI/course.php" target="_blank"><span data-hover="Find Courses">Find Courses</span></a></li>
							<li>/</li>
							<li><a class="scroll" href="http://localhost/IITH-Course-Schedule/UI/instructor.php" target="_blank"><span data-hover="Find Instructor">Find Instructor</span></a></li>
							<li>/</li>
							<li><a class="scroll" href="http://localhost/IITH-Course-Schedule/UI/add_course.php" target="_blank"><span data-hover="Add Course">Add Course</span></a></li>
							<li>/</li>
							<li><a class="scroll" href="http://localhost/IITH-Course-Schedule/Server/logout.php" target="_blank"><span data-hover="Log Out">Log Out</span></a></li>
							<li>/</li>
							
					 </nav>
				  </ul>			 	 
			  </div>	
				<!-- script-for-menu -->
			 <script>
				$("span.menu").click(function(){
					$(".top-menu ul").slideToggle("slow" , function(){
					});
				});
			 </script>
			 <!-- script-for-menu -->
			 <div class="clearfix"></div>			
		 </div>	 
		 <div class="banner-info">	
			<h1>WELCOME !</h1>
			<h3>WE ARE HAPPY YOU ARE HERE</h3>
			<a class="downarrow scroll" href="#service"><span> </span></a>
		 </div>
	 </div>
</div>
<!---->

<!---fotter-->
<div class="fotter">
	 <p>Copyrights &copy; 2015 | Template by <a href="http://w3layouts.com/">W3layouts</a></p>
</div>
<!---->

<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<script type="text/javascript">
		$(document).ready(function() {
				/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
</body>
</html>