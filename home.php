<?php
	require_once "config.php";

	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: loginp.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	$_SESSION['id'] = $userData['id'];
	$_SESSION['email'] = $userData['email'];
	$_SESSION['gender'] = $userData['gender'];
	$_SESSION['picture'] = $userData['picture'];
	$_SESSION['familyName'] = $userData['familyName'];
	$_SESSION['givenName'] = $userData['givenName'];

	header('Location: index.php');
	exit();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BGnotes - Home</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Adamina">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/carica2.css">
    <link rel="stylesheet" href="assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/Drag-Drop-File-Upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/Map-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/reimpostapassword.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="assets/css/hover.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
        
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="filter: saturate(200%);font-family: Akronim, cursive;font-size: 12px;height: 90.375px;">
        <div class="container"><a class="navbar-brand logo" href="home.html" style="font-family: Akronim, cursive;font-size: 37px;color: rgba(6,3,0,0.9);width: 73.9531px;letter-spacing: 5px;">BGnotes</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1" style="font-family: Montserrat, sans-serif;width: 987.312px;height: 24px;margin: -1px;padding: -35px;">
                <ul class="nav navbar-nav ml-auto" style="width: 345px;margin: -23px;margin-top: 0px;margin-right: 0px;margin-bottom: 0pz;margin-left: 127.234px;">
                   
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation" style="width: 32px;height: 35px;margin-right: 48px;"><a class="nav-link active " href="home.html" style="font-family: Adamina, serif;">HOME</a></li>
                    <li class="nav-item" id="navLogin" role="presentation"><a class="nav-link active" href="loginp.html" style="font-family: Adamina, serif;">LOG IN</a></li>
                    <li class="nav-item" id="navRegistrati" role="presentation"><a class="nav-link active" href="registration.html" style="font-family: Adamina, serif;">REGISTRATI</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="about-us.html" style="font-family: Adamina, serif;">ABOUT US</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="faq.html" style="font-family: Adamina, serif;width: 75.9375px;">FAQ</a></li>
					<li class="nav-item" id="navLoggato" role="presentation"></li>
                </ul>
                
            </div>
        </div>
    </nav>
    <main class="page" style="background-image: url(assets/img/sfondo1.png)">
        <section class="clean-block ">
            <div class="container">
                <div class="block-heading">
                    
                    <p></p>
                </div>
                <h2 class="text-info text-center">Scegli cosa fare</h2>

            


            
                <div class="grid">
                    <figure class="effect-sadie">
                        <img src="assets/img/tech/gruppi.png" alt="img02"/>
                        <figcaption>
                            <h2>Cerca <span>gruppi</span></h2>
                            <p>Conosci nuove persone nelle tue vicinanze per affrontare al meglio gli esami</p>
                            <a href="mappa.html">View more</a>
                        </figcaption>           
                    </figure>
                    <figure class="effect-sadie">
                        <img src="assets/img/tech/cerca.jpg" alt="img14"/>
                        <figcaption>
                            <h2>Cerca<span> documenti</span></h2>
                            <p>Qui potrai trovare appunti , libri , esercizi , riassunti e schemi per aiutarti a studiare</p>
                            <a href="catalogomaterie.html">View more</a>
                        </figcaption>           
                    </figure>
                    <figure class="effect-sadie">
                        <img src="assets/img/tech/carica.jpg" alt="img14"/>
                        <figcaption>
                            <h2>Carica un <span>documento</span></h2>
                            <p>Aiuta la community caricando i tuoi appunti , riassunti o tutto ciò che può aiutare</p>
                            <a href="caricafile.html">View more</a>
                        </figcaption>           
                    </figure>
                </div>
                </div>
             </div>
        </section>
    </main>
	
    <script type="text/javascript"  src="assets/js/GestioneCookie.js">
	</script>
	<script>
	isLogged();
	</script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="assets/js/untitled.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    

  


</body>

</html>