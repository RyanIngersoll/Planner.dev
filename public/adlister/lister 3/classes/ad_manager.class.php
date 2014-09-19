<?php
require_once 'ad.class.php';

class AdManager {
    public $filename = '';
    
    public function __construct($filename = 'data/ads.csv') {
        $this->filename = $filename;
    }
    
    public function showAds() {
        $handle = fopen($this->filename, 'r');
        $ads = [];
        while (!feof($handle)) {
            $row = fgetcsv($handle);
            
            if (!empty($row)) {
                $advert = new Ad($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                $ads[] = $advert;
            }
        }
        fclose($handle);
        return $ads;
    }
    
    public function saveAds($ads) {
        $handle = fopen($this->filename, 'w');
        foreach ($ads as $ad) {
            fputcsv($handle, $ad->adArray());
        }
        fclose($handle);
    }
    
}
