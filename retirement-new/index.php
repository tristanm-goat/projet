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
<div class="index-discovery">
          <h1>Discover Your Ideal Retirement Lifestyle</h1>
          <h2>Navigate your future with confidence. We provide comprehensive, personalized information on retirement facilities, helping you find the perfect community to call home.</h2>
          <button onclick="window.location.href='facility.php'"><a href="facility.php" class="intro-button">Find Facilities Near You</a></button>
</div>

<!-- Services -->
<div class="index-services-parallax" data-parallax="scroll" data-image-src="img/coffee-glass.jpg">
  <div class="index-services">
      <h1>Our Services</h1>
      <div class="index-services-container">
            <div class="index-services-docker">
                      <h1>Find Your Perfect Retirement Comunity</h1>
                      <h2>Navigate your next chapter with confidence and ease. We provide personalized insights and comprehensive information to connect you with facilities that match your unique lifestyle and care needs.</h2>
                  </div>
            <div class="index-services-docker">
                      <h1>Clear path to Retirement Living</h1>
                      <h2>Stop guessing. Access verified reviews, detailed facility profiles, and transparent information to make the best decision. Your ideal retirement home is just a few clicks away.</h2>
            </div>
            <div class="index-services-docker">
                      <h1>Local Expert Support</h1>
                      <h2>Speak with a dedicated local care advisor at any stage of your search. Get objective advice and answers to your complex questions at no cost to you.</h2>
            </div>
      </div>
  </div>
</div>

<!-- Page footer -->
<?php include 'view/footer.php'; ?>
</body>

<!--javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
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
</html>