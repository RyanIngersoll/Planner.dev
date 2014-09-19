<?php 

// var_dump($ads);

// // ALLOW USER TO UPLOAD A CSV FILE TO IMPORT CONTACTS INTO THE ADDRESS BOOK
// if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
//     // UPLOAD DIRECTORY PATH
//     $uploadDir = '/vagrant/sites/codeup.dev/public/lister/img/';
//     $uploadFilename = basename($_FILES['fileUpload']['name']);
//     // UPLOADED PATH AND FILENAME
//     $savedFile = $uploadDir . $uploadFilename;
//     // MOVE TMP FILE TO UPLOADS DIRECTORY
//     move_uploaded_file($_FILES['fileUpload']['tmp_name'], $savedFile);
// }

// // AFTER FILE IS UPLOADED, SAVE NEW CONTACTS TO THE ADDRESS BOOK 
// if (!empty($_FILES) && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
//     // CREATE A NEW ADDRESSDATASTORE OBJECT TO COPY THE NEW CONTACTS
//     $adImage = [];
//     $id = count($ads) - 1;
//     $ads[$id] = array_merge($ads[$id], $adImage);
//     $adManager->saveAds($ads[$id]);
// }

//     header('location: view.php?=' . (count($ads) - 1));
//     exit;

?>

<? 
require_once 'classes/ad_manager.class.php';
require_once 'classes/ad.class.php';
?>

<? include 'header.php' ?>

<h2>Add an Image</h2>
<form method="POST" action="/addimage.php" enctype="multipart/form-data" class="form-horizontal">
    <label for="upload">File to Import:</label>
    <input type="file" name="fileUpload" id="upload" class="form-control"><br>
    <input type="submit" value="Import" class="btn btn-primary">
</form>

<? include 'footer.php' ?>