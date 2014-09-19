<?
require_once 'classes/ad_manager.class.php';
require_once 'classes/ad.class.php';

$adManager = new AdManager();
$ads = $adManager->showAds();

$adID = $_GET['id'];
$ad = $ads[$adID];

?>

<? include 'header.php'; ?>
    <div class="container">
        <div class="jumbotron">
            <h1><?= $ad->title; ?></h1>
            <p><?= $ad->body; ?></p>
            <p><a href="editad.php?id=<?= $adID ?>">Edit</a></p>
        </div>
        <p><em>Posted: <?= $ad->listDate; ?></em></p>
        <p>Contact: <a href="mailto:<?= $ad->email; ?>"><?= $ad->username; ?></a></p>
        <img src="img/<?= $ad->img; ?>" class="img-responsive" alt="Responsive image">
    </div>
