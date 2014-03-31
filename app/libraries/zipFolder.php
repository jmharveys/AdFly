<?php
include 'utilities.php';

$folder = $_POST['folder'];
$name = $_POST['name'];
$zip = $folder . "/" . $name . ".zip";

if(file_exists($zip)) {
    unlink($zip);
}

try {
    App_File_Zip::CreateFromFilesystem($folder, $zip);
    $file_name = basename($zip);
} catch (App_File_Zip_Exception $e) { // Zip file was not created.
    echo "Le zip n'as pu être créé.";
}
?>