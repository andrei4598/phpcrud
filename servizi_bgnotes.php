<?php
require '../../php_enc/database.php';

if (isset($_POST["nome_servizio"]))
{
    $nome_servizio = $_POST["nome_servizio"];
}
else
{
    $nome_servizio = null;
}

if (isset($_POST["parametri"]))
{
    $parametri = $_POST["parametri"];
}
else
{
    $parametri = null;
}
if ($nome_servizio == null)
{
    echo "ti sei scordato il nome del servizio";
}
if ($parametri == null)
{
    echo "\n ti sei scordato i parametri";
}

//--------------------------------------------------------------------------------------------------------------------------------------------------
if ($nome_servizio == "stampa")
{
    echo " hai richiesto di stampare " . $parametri;
}
if ($nome_servizio == "vedi_db")
{
    vedidb();
}
if ($nome_servizio == "registra")
{
    registra($parametri);
}
if ($nome_servizio == "add_ricerca_gruppo")
{
    add_ricerca_gruppo($parametri);
}
if ($nome_servizio == "login")
{
    login($parametri);
}
if ($nome_servizio == "reset_password")
{
    resetpassword($parametri);
}
if ($nome_servizio == "salva_file")
{
    echo "nome servizio";
    saveFile($parametri);
}
if ($nome_servizio == "get_documenti")
{
    get_documenti($parametri);
}
if ($nome_servizio == "get_gruppi")
{
    get_gruppi($parametri);
}
if ($nome_servizio == "get_gruppi_form_mappa")
{
    get_gruppi_form_mappa($parametri);
}

//--------------------------------------------------------------------------------------------------------------------------------------------------
function registra($param)
{
    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);

    $sql = "SELECT * FROM attori WHERE email = '" . $arr["email"] . "'";

    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        $row = mysqli_fetch_assoc($result);
        $ris = json_encode($row);
        if ($ris == "null")
        {
            $sql = "INSERT INTO attori(nome, cognome, email,password,telefono) VALUES ('" . $arr["nome"] . "', '" . $arr["cognome"] . "', '" . $arr["email"] . "','" . $arr["password"] . "', '" . $arr["telefono"] . "')";

            if ($conn->query($sql) === true)
            {
                echo "New record created successfully";
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }
        else
        {
            echo "sei già registrato";
        }
        mysqli_free_result($result);
    }
    else
    {
        echo "Errore nalla connessione";
    }
    // Close connection
    mysqli_close($conn);
}

//--------------------------------------------------------------------------------------------------------------------------------------------------
function add_ricerca_gruppo($param)
{
    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);

    $sql = "INSERT INTO gruppi (nome, email, telefono,categoria,commento,latitudine,longitudine) VALUES ('" . $arr["nome"] . "', '" . $arr["email"] . "', '" . $arr["telefono"] . "','" . $arr["categoria"] . "', '" . $arr["commento"] . "', '" . $arr["latitudine"] . "', '" . $arr["longitudine"] . "')";

    if ($conn->query($sql) === true)
    {
        echo "Richiesta inserita con successo";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    mysqli_close($conn);
}
//--------------------------------------------------------------------------------------------------------------------------------------------------


function saveFile($param)
{
    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    $arr = json_decode($param, true);
    echo "prova " . $arr["fileb64"];

}

function login($param)
{
    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);

    $sql = "SELECT * FROM attori WHERE email = '" . $arr["email"] . "'";
    $exist = "false";
    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        $row = mysqli_fetch_assoc($result);
        $ris = json_encode($row);
        if ($ris == "null")
        {
            echo "utente non registrato";
            return;
        }
        else
        {
            $exist = "true";
			session_start();
			$_SESSION["favcolor"] = "green";
			$_SESSION["loggato"] =session_id();
			$_SESSION['name']=$arr["email"];
        }
        mysqli_free_result($result);
    }
    else
    {
        echo "Errore nella connessione login";
        return;
    }

    $sql = "SELECT * FROM attori WHERE email = '" . $arr["email"] . "' and password = '" . $arr["password"] . "'";
    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        $row = mysqli_fetch_assoc($result);
        $ris = json_encode($row);
        if ($ris == "null")
        {
            echo "password errata";
        }
        else
        {
            echo "login ok";
        }
        mysqli_free_result($result);

        // Close connection
        mysqli_close($conn);
    }
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function resetpassword($param)
{

    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    /* return name of current default database */
    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);
    $sql = "SELECT password FROM attori WHERE email = '" . $arr["email"] . "'";
    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        $row = mysqli_fetch_assoc($result);
        if ($row != null)
        {
            $pass = $row["password"];
        }
        else
        {
            $pass = "";
        }

        $msg = "Gentile utente la sua password è :\n " . $pass;
        echo ("Se la mail è registrata riceverà una mail con la password.");
        $msg = wordwrap($msg, 70);
        $email = $arr["email"];
        if ($pass != "")
        {
            mail($email, "BGnotes Recupero Password", $msg);

        }

        /* free result set */
        mysqli_free_result($result);

    }
    else
    {
        echo "Errore nella connessione";
    }
    // Close connection
    mysqli_close($conn);
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function get_documenti($param)
{

    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    /* return name of current default database */
    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);
    if ($arr["tipo"] == "tutto")
    {
        $sql = "SELECT * FROM documenti";
    }
    else
    {
        $sql = "SELECT * FROM documenti WHERE categoria = '" . $arr["tipo"] . "'";
    }

    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        while ($row = mysqli_fetch_assoc($result))
        {
            //echo(json_encode($row));
            echo ' <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item" width="250" height="55">
                                            <iframe width="250" height="255"  src="' . $row["file_name"] . '"></iframe>
                                            <div class="product-name"><a href="#">' . $row["name"] . '</a></div>
                                            <div class="border-light about"><a href="' . $row["file_name"] . '" class="btn btn-light" style="background-color: rgb(255, 255, 255); border : 1px solid red">Anteprima</a><a href="' . $row["file_name"] . '" class="btn btn-primary" style="background-color: rgb(38,176,26);" download>Download</a></div>
                                                <div class="price"></div>
                                            </div>
                                        </div>';

        }
        /* free result set */
        mysqli_free_result($result);

    }
    else
    {
        echo "Errore nella connessione";
    }
    // Close connection
    mysqli_close($conn);
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function get_gruppi($param)
{

    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    /* return name of current default database */
    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);
    $sql = "SELECT * FROM gruppi";

    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
	
	
        echo '
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Nome</th>
			<th scope="col">Telefono</th>
			<th scope="col">Email</th>
            <th scope="col">Commento</th>
            <th scope="col">Categoria</th>
			<th scope="col"></th>
          </tr>
        </thead><tbody>';

        while ($row = mysqli_fetch_assoc($result))
        {
            //echo(json_encode($row));
			$pro=json_encode($row);
			$pro= str_replace('"', '&apos', $pro);
            echo ' <tr>
            <th >' . $row["nome"] . '</th>
			<th >' . $row["telefono"] . '</th>
			<th >' . $row["email"] . '</th>
            <td>' . $row["commento"] . '</td>
            <td>' . $row["categoria"] . '</td>
            <td>
              <button type="button" class="btn btn-info" id="btn' . $row["idr"] . '" onclick="showMappa('."'".$pro."'".')">vedi</button>
            </td>
          </tr>';

        }

        /* free result set */
        echo ' </tbody>
      </table>
    </div>
  </div>';

        mysqli_free_result($result);

    }
    else
    {
        echo "Errore nella connessione";
    }
    // Close connection
    mysqli_close($conn);
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function get_gruppi_form_mappa($param)
{

    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    /* return name of current default database */
    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $arr = json_decode($param, true);
    $sql = "SELECT * FROM gruppi";

    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
		$rows = array();
        while ($row = mysqli_fetch_assoc($result))
        {
           $rows[] = $row;
        }
		echo json_encode($rows);
        /* free result set */

        mysqli_free_result($result);

    }
    else
    {
        echo "Errore nella connessione";
    }
    // Close connection
    mysqli_close($conn);
}

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function vedidb()
{
    echo "ciao";
    $conn = connetti_db();

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn)
    {

    }

    /* return name of current default database */
    if ($result = $conn->query("SELECT DATABASE()"))
    {
        $row = $result->fetch_row();
        $result->close();
    }

    $sql = "SELECT * FROM attori";
    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        while ($row = mysqli_fetch_assoc($result))
        {
            echo (json_encode($row));
        }
        /* free result set */
        mysqli_free_result($result);

    }
    else
    {
        echo "Errore nella connesione";
    }
    // Close connection
    mysqli_close($conn);
}

?>
