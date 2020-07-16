<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory
if(!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['categoria'])|| $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{
echo "<img src='$path' />";
$name = $_POST['name'];
$email = $_POST['email'];
$categoria = $_POST['categoria'];
//include database configuration file
require '../../php_enc/database.php';
$conn = connetti_db();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($result = $conn->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    $result->close();
}

$sql ="INSERT documenti (name,email,file_name,categoria) VALUES ('".$name."','".$email."','".$path."','".$categoria."')";
if ($conn->query($sql) === TRUE)
{
	echo "Documento inserito con successo";
} else 
{
	echo "Error: " . $sql . "<br>" . $conn->error;
}
		




//insert form data in the database

//echo $insert?'ok':'err';
}
} 
else 
{
echo 'invalid';
}
}
?>