<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>LifeMap</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/templatemo-style.css" />
    <link rel="stylesheet" href="css/styles.css" />

  </head>
  <body>
    <div class="parallax-window" data-parallax="scroll" data-image-src="img/bg-01.jpg">  
      <div class="container-fluid">

  <!-- Header -->
      <header>
	<!-- Logo Section -->
    <div class="logo-section">
      <img src="img/logo-png.png"  alt="LifeMap Logo" class="company-logo" />
      <span class="company-name" >Life</span><span class="company-name2">Map</span>
    </div>

	<!-- Navigation Menu -->
    <div class="main-nav">
      <ul>
        <li class="active"><div class="highlight">&#x23AF</div><a href="index.php">Home</a></li>
        <li><div class="highlight">&#x23AF</div><a href="about.php">About</a></li>
        <li><div class="highlight">&#x23AF</div><a href="services.php">Services</a></li>
        <li><div class="highlight">&#x23AF</div><a href="facility.php">Facility</a></li>
        <li><div class="highlight">&#x23AF</div><a href="contact.php">Contact</a></li>
		    <li><div class="highlight">&#x23AF</div><a id="login" href="login.php">Login</a></li>
	    	<li><a id="likes"></a></li>
      </ul>
    </div>
  </header>	
<!-- Separator Black Line -->
<div class="seperator-line"></div>

<!-- Features -->
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

        <!-- Services header -->
        <section class="row" id="tmServices">
          <div class="col-12">
            <div class="parallax-window tm-services-parallax-header"
                 data-parallax="scroll"
                 data-z-index="101"
                 data-image-src="img/coffee-glass.jpg">

                 <div class="tm-bg-black-transparent text-center tm-services-header">
                    <h2 class="text-uppercase tm-services-page-title">Our Services</h2>
                    <p class="tm-services-description mb-0 small">
                        Add text here about what a retirement home is and shit so that they can click the links below!. <br>
                        Aliquam egestas lectus semper enim malesuada, in convallis nunc sagittis.<br>
                        Pellentesque quis tellus vel tortor malesuada egestas.    
                    </p>
                </div>
            </div>
          </div>  

        <!-- Call to Action -->
        <section class="row" id="tmCallToAction">
          <div class="col-12 tm-call-to-action-col">
            <img src="img/call-to-action.jpg" alt="Image" class="img-fluid tm-call-to-action-image" />
            <div class="tm-bg-white tm-call-to-action-text">
              <h2 class="tm-call-to-action-title">Contactez-nous</h2>
              <p class="tm-call-to-action-description">
                Remplissez ce formulaire pour recevoir des informations ou de l'aide concernant les résidences pour aînés.
              </p>
              <form action="submit_form.php" method="post" class="tm-call-to-action-form">
                <div class="form-group">
                  <input name="name" type="text" class="tm-email-input" placeholder="Nom complet" required />
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="tm-email-input" placeholder="Email" required />
                </div>
                <div class="form-group">
                  <input name="phone" type="tel" class="tm-email-input" placeholder="Téléphone" />
                </div>
                <div class="form-group">
                  <select name="interested_in" class="tm-email-input" required>
                    <option value="">Intéressé par...</option>
                    <option value="trouver_residence">Trouver une résidence</option>
                    <option value="inscription_attente">Inscription sur liste d'attente</option>
                    <option value="gestion_etablissement">Gestion d'établissement</option>
                    <option value="autre">Autre</option>
                  </select>
                </div>
                <div class="form-group">
                  <textarea name="message" class="tm-email-input" rows="3" placeholder="Votre message ou question"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Envoyer</button>
              </form>
            </div>
          </div>
        </section>

        <!-- Page footer -->
        <footer class="row">
        </footer>
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