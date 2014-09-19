<?php
require_once 'ad.class.php';

// CLASS DEFINITION FOR AD MANAGER OBJECTS
class AdManager {
    public $filename = '';
    
    public function __construct($filename = 'data/ads.csv') {
        $this->filename = $filename;
    }
    // METHOD TO READ ADS FROM CSV DATASTORE
    public function showAds() {
        $handle = fopen($this->filename, 'r');
        $ads = [];
        while (!feof($handle)) {
            $row = fgetcsv($handle);
            // BUILD AD OBJECTS AND PUSH ONTO AN ARRAY
            if (!empty($row)) {
                $advert = new Ad($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                $ads[] = $advert;
            }
        }
        fclose($handle);
        return $ads;
    }
    
    // METHOD TO WRITE ADS TO THE CSV DATASTORE
    public function saveAds($ads) {
        $handle = fopen($this->filename, 'w');
        foreach ($ads as $ad) {
            fputcsv($handle, $ad->adArray());
        }
        fclose($handle);
    }
    
    // METHOD TO EDIT ADS
    public function editAds() {
        $ads = $this->showAds();
        var_dump($ads);
    }
    
}