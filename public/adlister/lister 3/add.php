<?php
require_once 'classes/ad_manager.class.php';
require_once 'classes/ad.class.php';

// ALLOW USER TO UPLOAD AN IMAGE TO THEIR AD
if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
    // UPLOAD DIRECTORY PATH
    $uploadDir = '/vagrant/sites/codeup.dev/public/lister/img/';
    $uploadFilename = basename($_FILES['fileUpload']['name']);
    // UPLOADED PATH AND FILENAME
    $savedFile = $uploadDir . $uploadFilename;
    // MOVE TMP FILE TO UPLOADS DIRECTORY
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $savedFile);
    $img = $uploadFilename;
}

if(!empty($_POST)) {
    $adManager = new AdManager();
    $ads = $adManager->showAds();
    $listedDate = date('D, d M Y H:i');
    
    $ad = new Ad($_POST['postTitle'], $_POST['postBody'], $listedDate, $_POST['postAuthor'], $_POST['postEmail'], $_POST['postImage']);

    $ads[] = $ad;
    
    $adManager->saveAds($ads);
    
    header('location: view.php?id=' . (count($ads) - 1));
    exit;
}

?>

<?
    include 'header.php';
?>
<div class="container">
    <h2 class="text-center">List&#40;er&#41; an Item</h2>
    <div class="row">
        <form method="POST" enctype="multipart/form-data" action="/lister/add.php" role="form" class="form-horizontal">
            <div class="form-group">
                <label for="upload" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-9">
                    <input type="file" name="fileUpload" id="upload" class="form-control"><br>
                    <input type="submit" value="Upload" class="btn btn-primary">
                </div>
            </div>
        </form>
        <form method="POST" action="/lister/add.php" role="form" class="form-horizontal">
            <div class="form-group">
                <label for="postTitle" class="col-sm-2 control-label">Title:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="postTitle" id="postTitle" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="postBody" class="col-sm-2 control-label">Body:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="postBody" id="postBody" rows="10" placeholder="Describe the item that you're listing here. Be creative..."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="postAuthor" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="postAuthor" id="postAuthor" placeholder="Janice Smithereens">
                </div>
            </div>
            <div class="form-group">
                <label for="postEmail" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="postEmail" id="postEmail" placeholder="janice.smithereens@email.com">
                </div>
            </div>
            <? if (count($_FILES) > 0 && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK):?>
                <input type="hidden" value="<?=$img ?>" name="postImage">
            <? endif; ?>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <a href="index.php" class="btn btn-default">Go Back</a>
                    <button type="submit" class="btn btn-primary">List It</button>
                </div>
            </div>
        </form>
    </div>
</div>
<? include 'footer.php'; ?>