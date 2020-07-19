# phpcrud
BGnotes. 19/07/2020
Il server è nato per lo sviluppo di un sito web che dia la possibilità agli utenti di registrarsi, caricare documenti, leggere e scaricare documenti, creare gruppi di studio,
visualizzare richieste di gruppi, avere una chat libera per confrontarsi.

Per far funzionare il tutto bisogna scaricare ed installare XAMPP (https://www.apachefriends.org/it/download.html).

Dopo aver installato XAMPP con i moduli per PHP 7 e il database InnoDB bisogna installare l'orchestratore che si occuperà di installare e gestire moduli di programma
esterni che useremo per la gestione ad esempio delle WebSocket tra i vari client ed il server.

Per installarlo basta andare sul sito (https://getcomposer.org/download/), installarlo dentro la cartella di XAMPP e selezionare il file php.exe.
Una volta installato l'orchestratore avremmo bisogno del modulo di programma esterno per la gestione delle websocket, in questo caso useremo
cboden/ratchet.

Per installare cboden/ratchet bisogna posizionarsi tramite il terminale nella cartella htdocs della nostra applicazione e digitare:
composer require cboden/ratchet.

Una volta installato il modulo aggiuntivo avremmo quindi a disposizione la nostra WebSocket che ci consentirà di comunicare in modo asincrono con i vari client
che si autenticheranno.

Per l'autenticazione ci sono 2 modi differenti, registrazione manuale inserendo i dati o login tramite Google.
Per il login tramite google sfrutteremo le API messe a disposizione da Google Developers, bisogna quindi iscriversi quindi a https://developers.google.com/ , creare un nuovo progetto
e richiedere l'abilitazione dell'api per oAuth, questa vi fornirà 1 key pubblica e una segreta che serviranno per l'autenticazione.
Sempre dalla console di google bisognerà inserire l'url a cui l'api di oAuth darà accesso (localhost:8080/phpcrud/...), oAuth risponderà con successo e avrà una funzione
di callback in nella quale possiamo estrarre i dati, creare la sessione e reindirizzarci alla pagina di home.

Un altro servizio importante è quello per richiedere la password dimenticata, per farlo ci appoggeremo sempre al nostro account Google, questa volta da GMAIL bisognerà attivare
le applicazioni meno sicure e specificare l'url base della nostra app.
Dopo aver ottenuto il consenso da google si passa alla parte di configurazione del nostro server SMTP interno, per fare ciò bisogna andare dentro la nostra cartella di XAMPP,avremo
già a disposizione la cartella sendmail, che andrà configurata con i dai relativi al server SMTP di google ed i nostri dati personali.
smtp_server=smtp.gmail.com
smtp_port=587

smtp_ssl=auto

auth_username= la tua mail
auth_password=password della tua mail in chiaro ( non è il massimo ma si presuppone che alla cartella del server si acceda solamente tramite id e password)


Ora che abbiamo sistemato anche la parte dell'invio email bisogna bisogna fare riferimento al sito (https://leafletjs.com/reference-1.6.0.html) per quanto riguarda il servizio
esterno per la gestione delle mappe, per usarlo bisogna creare un account su (https://www.mapbox.com/) ed uno su (https://leafletjs.com/), nei seguenti siti troverete tutta
la documentazione che riguarda i servizi esterni.

Procediamo poi a vedere i servizi del nostro server, per semplificare il lavoro dei programmatori che vogliano implementare un nostro servizio con facilità d'uso,utilizzando 1 
funzione universale a cui passare i parametri ho optato per creare un unico file dei servizi, che sarà l'unico ad avere accesso ad una cartella dentro il nostro server (php_enc) 
che conterrà i dati del nostro database.
La pagina dei servizi in questione è "/servizi_bgnotes.php" questa pagina è il fulcro del nostro server, gran parte delle richieste di CREATE, UPDATE, SELECT passa da qui.
E' possibile chiamare la pagina in POST mandando 2 parametri : "nome_servizio" che conterrà il nome del servizio che vogliamo chiamare, "parametri" che conterrà i parametri
richiesti dal servizio in questione, il tutto in formato standard JSON. 
Avendo a disposizione solo questo url e i 2 parametri sarà di facile utilizzo per programmatori futuri anche inesperti modificare e creare nuovi servizi compatibili sin da subito
con altre applicazioni che hanno deciso di utilizzare il servizi del nostro server.In questo modo qualsiasi modifica ai parametri richiesti sarà immediata,perché il numero di 
parametri che possiamo mandare in un JSON non è fisso, possiamo mandare anche 50 parametri, ma se la funzione lato server ne richiede solo uno andrà a prendersi direttamente quello.

Che dire per chiamare un qualsiasi nostro servizio la chiamata sarà molto semplice.
In AJAX basterà fare come nel seguente esempio:
var obj = {}; // oggetto generico che conterrà i vari parametri da mandare al servizio
	obj.email = $("#email").val();
     $.ajax({
         type: "POST", //chiamata in post per nascondere i nomi dei parametri 
         url: "http://localhost/phpcrud/servizi_bgnotes.php", //url main del nostro servizio
         data: { nome_servizio: "reset_password",parametri:JSON.stringify(obj) }, //nome_servizio conterrà il nome del servizio che vogliamo chiamare, mentre parametri conterrà il nostro  oggetto in JSON con la lista dei vari parametri anche non ordinata.
         success: function(data) { // funzione di callback che conterrà il messaggio che manda indietro il server se la chiamata ha status 200.
            // on successfull return it will alert the data 
			alert("Messaggio del server: " + data);
         }
      });
      
      
A questo punto non resta che esplorare i vari servizi richiesti , per farlo basta andare alla pagina (http://localhost/phpcrud/descrizione_servizi.html) che conterrà
le specifiche dei parmetri che i singoli servizi richiedono.
