	function clearStore()
	{

	  localStorage.clear();
	  window.location.replace("/phpcrud/home.html");
	  document.getElementById('navLoggato').innerHTML = '';
	  
	}
	function isLogged()
	{
		var storedPw = localStorage.getItem("loggato");
		var strCookies = document.cookie;
		var cookiearray = strCookies.split(';')

		for(var i=0; i<cookiearray.length; i++)
		{
			name = cookiearray[i].split('=')[0];
			value = cookiearray[i].split('=')[1];
			if((value==storedPw) && value !=null)
			{
				var elem = document.getElementById('navRegistrati');
				elem.parentNode.removeChild(elem);
				var elem = document.getElementById('navLogin');
				elem.parentNode.removeChild(elem);
				document.getElementById('navLoggato').innerHTML = '<button class="btn" ><i type="button"  height="2" onclick="clearStore()" class="fa fa-sign-out" aria-hidden="true">Log out</i></button>';
		
			}
			else
			{
				var n = window.location.href.indexOf("loginp.php");
				var nn = window.location.href.indexOf("loginp.html");
				var m = window.location.href.indexOf("registration.html");
				var indL = window.location.href.indexOf("index");
				if((n==-1 && nn==-1 && m==-1) && indL==-1)
				{
					alert("Non sei autorizzato devi Loggarti o Registrati");
					window.location.replace("/phpcrud/loginp.html");
				}
			}
		}

	}
	