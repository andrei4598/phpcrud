<?php
require '../../php_enc/database.php';

if (isset($_POST["parametri"]))
{
    $parametri = $_POST["parametri"];
}

delete($parametri);


//--------------------------------------------------------------------------------------------------------------------------------------------------
function delete($param)
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

    $sql = "DELETE * FROM attori WHERE email = '" . $arr["email"] . "'";

    if ($result = mysqli_query($conn, $sql))
    {
        /* fetch associative array */
        $row = mysqli_fetch_assoc($result);
        $ris = json_encode($row);
        mysqli_free_result($result);
    }
    else
    {
        echo "Errore nalla connessione";
    }
    // Close connection
    mysqli_close($conn);
}



?>
