<?php 
//Get the uploaded file information
$name = $_POST['name'];
$mail = $_POST['email'];
$department = $_POST['department'];
$idresumen = $_POST['id_resumen'];
$name_of_uploaded_file = basename($_FILES['uploaded_file']['name']);
$name_of_uploaded_file_2 = basename($_FILES['uploaded_file_2']['name']);


//get the file extension of the file
$type_of_uploaded_file = substr($name_of_uploaded_file,strrpos($name_of_uploaded_file, '.') + 1);
$size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;//size in KBs

//Settings
$max_allowed_file_size = 100; // size in KB
$allowed_extensions = array("jpg", "jpeg", "gif", "png", "pdf");

//Validations
if($size_of_uploaded_file > $max_allowed_file_size )
{
  $errors .= "\n Size of file should be less than $max_allowed_file_size";
}

//------ Validate the file extension -----
$allowed_ext = false;
for($i=0; $i<sizeof($allowed_extensions); $i++)
{
  if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
  {
    $allowed_ext = true;
  }
}

if(!$allowed_ext)
{
  $errors .= "\n The uploaded file is not supported file type. ".
  " Only the following file types are supported: ".implode(',',$allowed_extensions);
}
//copy the temp. uploaded file to uploads folder
$upload_folder = "uploads/";

$path_of_uploaded_file = $upload_folder . uniqid('pago_', true) . '.' . $type_of_uploaded_file;
$tmp_path = $_FILES["uploaded_file"]["tmp_name"];

if(is_uploaded_file($tmp_path))
{
  if(!copy($tmp_path,$path_of_uploaded_file))
  {
    $errors .= '\n error while copying the uploaded file';
  }
}

//prueba de estudiante
if (strlen($name_of_uploaded_file_2)){

    $name_of_uploaded_file_2 = basename($_FILES['uploaded_file_2']['name']);


    //get the file extension of the file
    $type_of_uploaded_file_2 = substr($name_of_uploaded_file_2,strrpos($name_of_uploaded_file_2, '.') + 1);
    $size_of_uploaded_file_2 = $_FILES["uploaded_file_2"]["size"]/1024;//size in KBs


    //Validations
    if($size_of_uploaded_file_2 > $max_allowed_file_size )
    {
    $errors .= "\n Size of file should be less than $max_allowed_file_size";
    }

    //------ Validate the file extension -----
    $allowed_ext = false;
    for($i=0; $i<sizeof($allowed_extensions); $i++)
    {
    if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file_2) == 0)
    {
        $allowed_ext = true;
    }
    }

    if(!$allowed_ext)
    {
    $errors .= "\n The uploaded file is not supported file type. ".
    " Only the following file types are supported: ".implode(',',$allowed_extensions);
    }
    {
        // Work your server side magic here
    }
    //copy the temp. uploaded file to uploads folder
    $path_of_uploaded_file_2 = $upload_folder . uniqid('estudiante_', true) . '.' . $type_of_uploaded_file_2;
    $tmp_path_2 = $_FILES["uploaded_file_2"]["tmp_name"];

    if(is_uploaded_file($tmp_path_2))
    {
    if(!copy($tmp_path,$path_of_uploaded_file_2))
    {
        $errors .= '\n error while copying the uploaded file';
    }
    }

}




$name = $_POST['name'];
$mail = $_POST['email'];
$department = $_POST['department'];
$idresumen = $_POST['id_resumen'];

$to_email = 'info@cboresearch.com';
$subject = 'Testing PHP Mail';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$mail."\r\n".
    'Reply-To: '.$mail."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 

// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">New submission!</h1>';
$message .= '<p style="color:#080;font-size:18px;">El usuario' . $name .'</p>';
$message .= '<p style="color:#080;font-size:18px;">Su email es:' . $mail .'</p>';
$message .= '<p style="color:#080;font-size:18px;">Registrado como:' . $department .'</p>';
$message .= '<p style="color:#080;font-size:18px;">ID del resumen aceptado es:' . $idresumen .'</p>';
$message .= '<p style="color:#080;font-size:18px;">El archivo de prueba de pago esta en: <a href="http://cboresearch.com/' . $path_of_uploaded_file .'">click here</a></p>';
if (strlen($name_of_uploaded_file_2)){
    $message .= '<p style="color:#080;font-size:18px;">El archivo de prueba de estudiante esta en: <a href="http://cboresearch.com/' . $path_of_uploaded_file_2 .'">click here</a></p>';
}
$message .= '</body></html>';

mail($to_email,$subject,$message,$headers);
?>