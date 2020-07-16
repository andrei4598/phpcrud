<?php
    require_once "config.php";

	if (isset($_SESSION['access_token'])) {
		header('Location: index.php');
		exit();
	}

	$loginURL = $gClient->createAuthUrl();
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>BGnotes - Log in</title>
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/login.css">
      <link rel="stylesheet" href="assets/css/Map-Clean.css">
      <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
      <link rel="stylesheet" href="assets/css/reimpostapassword.css">
      <link rel="stylesheet" href="assets/css/smoothproducts.css">
      <link rel="stylesheet" href="assets/css/responsive.css">
   </head>
   <body>
      <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="filter: saturate(200%);font-family: Akronim, cursive;font-size: 12px;height: 90.375px;">
         <div class="container">
            <a class="navbar-brand logo" href="home.html" style="font-family: Akronim, cursive;font-size: 37px;color: rgba(6,3,0,0.9);width: 73.9531px;letter-spacing: 5px;">BGnotes</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
               class="collapse navbar-collapse" id="navcol-1" style="font-family: Montserrat, sans-serif;width: 987.312px;height: 24px;margin: -1px;padding: -35px;">
               <ul class="nav navbar-nav ml-auto" style="width: 345px;height: 37px;margin-left: 127.234px;margin-bottom: 0px;margin-right: 0px;margin-top: 0px;">
                 
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
      <main class="page login-page" style="margin-bottom: 2px;padding-bottom: 5px;">
         <section class="clean-block clean-form dark" style="background-image: url(assets/img/sfondo1.png)">
            <div class="container">
               <div class="block-heading">
               </div>
               <form name="loginForm" class="border border-light p-5" >
                  <p class="h4 mb-4 text-center">Entra in BGnotes</p>
                  <input name="loginEmail" type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" required autofocus>
                  <input name="loginPassword" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" required ">
                  <div class="d-flex justify-content-between">
                     <div>
                        <div class="custom-control custom-checkbox"  >
                           <input name="remember" type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                           <label class="custom-control-label" for="defaultLoginFormRemember">Ricordami</label>
                        </div>
                     </div>
                     <div>
                        <a href="reimpostapassword.html">Password dimenticata??</a>
                     </div>
                  </div>
                  <button id="btnLogin" name="btnLogin" class="btn btn-info btn-block my-4" type="button">Entra</button>
				  <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn btn-danger">
                  <div class="text-center">
                     <p>Non sei registrato?
                        <a href="registration.html">Registrati</a>
                     </p>
                  </div>
               </form>
            </div>
         </section>
      </main>
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
      <script src="assets/js/smoothproducts.min.js"></script>
      <script src="assets/js/theme.js"></script>
      <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
      <script src="assets/js/untitled.js"></script>
      <script type="text/javascript" lang="javascript" src="assets/js/loginScript.js"></script>
	   <script type="text/javascript"  src="assets/js/GestioneCookie.js">
	</script>
	<script>
	isLogged();
	</script>
      <script>
         $(document).ready(function() {
                     $("#btnLogin").click(function()
                 {
				 
				  var check="true";
				  var email=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
				if(!email.test(document.loginForm.defaultLoginFormEmail.value))
				{
					check="false";
				}
		 
				 if(check=="true")
				 {
					var obj = {};
                 obj.email = document.loginForm.defaultLoginFormEmail.value;
                 obj.password = document.loginForm.defaultLoginFormPassword.value;
                 $.ajax({
                 type: "POST",
                 url: "http://localhost/phpcrud/servizi_bgnotes.php",
                 data: { nome_servizio: "login",parametri:JSON.stringify(obj) },
                 success: function(data) {
                 // on successfull return it will alert the data 
                 
				 if(data=="utente non registrato")
				 {
				  window.location.replace("/phpcrud/registration.html");
				 }
				 else{
						if(data=="login ok")
						{
							 $.ajax({
								type: "POST",
								url: "http://localhost/phpcrud/local_session.php",
							data: { parametri:"" },
								success: function(data) {
								window.location.replace("/phpcrud/home.html");
								localStorage.setItem("loggato", data);
							}
							});
							
						
						}else
						{
							alert("Messaggio del server: " + data);
							
						}
					}
                 }    
                 });
				 }
         	 
				 
                 });
				 
				 $("#defaultLoginFormEmail").change(function()
         {
         
         var email=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
         if(!email.test(document.loginForm.defaultLoginFormEmail.value)) {
         $(this).css("border","1px solid red");
         } else {
         $(this).css("color","black");
		 $(this).css("border","1px solid #ced4da");
         }
            
         });
         	 
         	 });
      </script>

     
   </body>
</html>