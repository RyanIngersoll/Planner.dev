<?php
require_once 'classes/ad_manager.class.php';
require_once 'classes/ad.class.php';

// CREATE AD MANAGER AND ADS OBJECTS
$adManager = new AdManager();
$ads = $adManager->showAds();
?>

<? include 'header.php'; ?>
<div id="pageWrap">
    <div class="page-header">
        <div class="col-sm-8 col-sm-offset-2">
            <h1>Fake Ad Listings <br><small>List Your Fake Cool Stuff</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <!-- LOOP THROUGH ADS TO DISPLAY ALL ADS IN CSV DATASTORE -->
                <? foreach($ads as $adIndex => $adContent): ?>
                    <div class="col-sm-4 col-md-4">
                     <?= $adIndex % 3 == 0 ? 'clear' : '' ?>
                        <div class="thumbnail adListing">
                            <a href="view.php?id=<?= $adIndex ?>"><img src="img/<?= $adContent->img; ?>" alt="<?= $adContent->title ?> Photo"></a>
                            <div class="caption">
                                <h3><a href="view.php?id=<?= $adIndex ?>"><?= $adContent->title; ?></a></h3>
                                <p>Contact: <?= $adContent->username; ?></p>
                                <p class="listDate"><em><?= $adContent->listDate; ?></em></p>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<? include 'footer.php'; ?>