
<?php 
if(isset($_GET['street'])) {
    //Get data from google geocode
    $geoCodeURL ="http://maps.google.com/maps/api/geocode/xml?address=".urlencode($_GET['street']).",".urlencode($_GET['city']).",".$_GET['state'];
    $geoData = file_get_contents($geoCodeURL);
    $xml=simplexml_load_string($geoData) or die("Error: Cannot create object");
    $latitude = $xml->result->geometry->location->lat;
    $longtitude = $xml->result->geometry->location->lng;
    //Get data from Forecast
    $units = "";
    $symbol = "";
    if($_GET['degree'] == "Fahrenheit") {
        $units = "us";
        $symbol = "F";
    }
    else {
        $units = "si";
        $symbol = "C";
    }
    $weatherURL ="https://api.forecast.io/forecast/"."1612f98ab37debd29fef9b0290f8ca95/".urlencode($latitude).",".urlencode($longtitude)."?"."units=".urlencode($units)."&"."exclude=flags";
    $json = file_get_contents($weatherURL);
    echo $json;
}
?>

