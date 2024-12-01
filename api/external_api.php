<?php
// Postavke API-ja
$api_key = 'your_api_key'; // Zamijeni svojim API ključem
$city = 'Zagreb'; // Grad za koji dohvaćamo podatke
$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key&units=metric"; // API URL

// Dohvati podatke s API-ja
$response = file_get_contents($url);

// Provjeri je li odgovor ispravan
if ($response === FALSE) {
    $api_data = ['error' => 'Unable to fetch data from API.'];
} else {
    // Pretvori JSON odgovor u PHP array
    $api_data = json_decode($response, true);
}

// Vrati podatke
return $api_data;
?>
