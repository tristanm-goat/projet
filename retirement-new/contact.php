<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Contact Page</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
  </head>
<body>
<?php include 'view/header.php'; ?>

<!-- Contact Form Section -->
<div class="login-body" style="margin-top: 20px; margin-bottom: 20px;">
    <div class="login-container" style="width: 500px; margin-top: 0px;">
      <h2>Contact Us</h2>
      <p style="color: black; margin-bottom: 20px;">Have a question or feedback? Fill out the form below and we'll get back to you as soon as possible.</p>
      <form action="contact.php" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your Name" required style="width: 100%; box-sizing: border-box;">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email Address" required style="width: 100%; box-sizing: border-box;">
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Subject" required style="width: 100%; box-sizing: border-box;">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Your Message" required style="width: 100%; height: 150px; box-sizing: border-box; font-family: inherit; font-size: 16px; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>
        <button type="submit" style="margin-top: 20px;">Send Message</button>
      </form>
    </div>
</div>


<?php include 'view/footer.php'; ?>
</body>
<!-- Javascript Section -->
<script>
  let userisloggedin = localStorage.getItem("userloggedin");
  if (userisloggedin == "true") {
	  document.getElementById("login").innerText = "Account";
	  document.getElementById("login").href = "portal.php";
	  document.getElementById("likes").innerHTML = '<div class="highlight">&#x23AF</div><a href="likes.php">Likes</a>';
  } else {;
  }

  document.querySelector("button[type='submit']").addEventListener("click", submit);

  function submit() {
    alert("Thank you for your message! We will get back to you shortly.");
    window.location.href = './index.php';
  }

</script>
</html>