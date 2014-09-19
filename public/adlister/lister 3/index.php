<?php
require_once 'classes/ad_manager.class.php';
require_once 'classes/ad.class.php';

$adManager = new AdManager();
$ads = $adManager->showAds();
?>

<? include 'header.php'; ?>
<div id="pageWrap">
    <div class="page-header">
        <div class="col-sm-8 col-sm-offset-2">
            <h1>Welcome to Lister <br><small>Search for an Ad, List an Ad. We don't care.</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <? foreach($ads as $adIndex => $adContent): ?>
                    <div class="col-sm-4 col-md-4 <?= $adIndex % 3 == 0 ? 'clear' : '' ?>">
                        <div class="thumbnail">
                            <a href="view.php?id=<?= $adIndex ?>"><img src="img/<?= $adContent->img; ?>" alt="..."></a>
                            <div class="caption">
                                <h3><a href="view.php?id=<?= $adIndex ?>"><?= $adContent->title; ?></a></h3>
                                <p>Contact: <?= $adContent->username; ?></p>
                                <p><em><?= $adContent->listDate; ?></em></p>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<? include 'footer.php'; ?>