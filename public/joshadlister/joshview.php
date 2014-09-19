<?
require_once 'classes/ad_manager.class.php';
require_once 'classes/ad.class.php';

// CREATE AD MANAGER AND ADS OBJECTS
$adManager = new AdManager();
$ads = $adManager->showAds();

// DISPLAY SELECTED AD
$adID = $_GET['id'];
$ad = $ads[$adID];

?>

<? include 'header.php'; ?>
    <div class="container">
        <div class="jumbotron">
            <!-- DISPLAY AD TITLE AND BODY -->
            <h1><?= $ad->title; ?></h1>
            <p><?= $ad->body; ?></p>
            <!-- LINK TO EDIT PAGE FOR AD -->
            <p class="btn btn-primary"><a href="editad.php?id=<?= $adID ?>">Edit</a></p>
        </div>
        <!-- POST DATE AND CONTACT INFO -->
        <p class="listDate"><em>Posted: <?= $ad->listDate; ?></em></p>
        <p>Contact: <a href="mailto:<?= $ad->email; ?>"><?= $ad->username; ?></a></p>
        <!-- CLICK AD IMAGE TO LOAD A MODAL IMAGE POPUP -->
        <img id="adImage" src="img/<?= $ad->img; ?>" class="img-responsive" alt="<?= $ad->title ?> Photo" data-toggle="modal" data-target="#modalImage">
        <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="modalImageLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal"><span id="closeButton" aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="modalImageLabel"><?= $ad->title; ?></h4>
                    </div>
                    <div class="modal-body">
                        <img id="largerModalImage"src="img/<?= $ad->img; ?>" class="img-responsive" alt="<?= $ad->title; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
<? include 'footer.php' ?>