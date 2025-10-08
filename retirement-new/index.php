<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>LifeMap</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" />
    <link rel="stylesheet" href="css/styles.css" />

  </head>
<body>


  <!-- Header -->
<?php include 'view/header.php'; ?>

<!-- Features -->
 <div class="parallax" data-parallax="scroll" data-image-src="img/bg-01.jpg">
  <div class="docker">
    <div class="docker-1" style="padding: 40px; max-width: 600px;">
          <h1 style="font-size: 2.8rem; margin-bottom: 15px; color: #8B0000;">Discover Your Ideal Retirement Lifestyle</h1>
          <h2 style="font-size: 1.2rem; line-height: 1.6; color: #333; font-weight: 400;">Navigate your future with confidence. We provide comprehensive, personalized information on retirement facilities, helping you find the perfect community to call home.</h2>
          <a href="facility.php" class="intro-button" style="display: inline-block; margin-top: 25px; padding: 15px 30px; background-color: #3aaed8; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s;">Find Facilities Near You</a>
    </div>
</div>
</div>

  	<div class="seperator-line" style="border: 20px solid black;"></div>

 <div class="parallax" data-parallax="scroll" data-image-src="img/coffee-glass.jpg">
  <div class="docker-1" style="width: 70%;">
          <h1>Services</h1>
  </div>
  <div class="docker">
    <div class="docker-1">
          <h1>Sample-Text-1</h1>
          <h2>Sample-description-2</h2>
    </div>
    <div class="docker-1">
          <h1>Sample-Text-1</h1>
          <h2>Sample-description-2</h2>
    </div>
    <div class="docker-1">
          <h1>Sample-Text-1</h1>
          <h2>Sample-description-2</h2>
    </div>
 </div>
</div>
    		<div class="seperator-line" style="border: 20px solid black;"></div>
 <div class="parallax" data-parallax="scroll" data-image-src="img/mobile-screen.jpg">
  <div class="docker">
    <div class="docker-1">
          <h1>Sample-Text-1</h1>
          <h2>Sample-description-2</h2>
    </div>
    <div class="docker-1">
          <h1>Sample-Text-1</h1>
          <h2>Sample-description-2</h2>
    </div>
    <div class="docker-1">
          <h1>Sample-Text-1</h1>
          <h2>Sample-description-2</h2>
    </div>
 </div>
</div>

        <!-- Page footer -->
<?php include 'view/footer.php'; ?>
      </div>
      <!-- .container-fluid -->
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>


  // Check if user is logged in
  let userisloggedin = localStorage.getItem("userloggedin");
  if (userisloggedin == "true") {
	  document.getElementById("login").innerText = "Account";
	  document.getElementById("login").href = "portal.php";
	  document.getElementById("likes").innerHTML = '<div class="highlight">&#x23AF</div><a href="likes.php">Likes</a>';
  } else {;
  }
</script>
  </body>
</html>