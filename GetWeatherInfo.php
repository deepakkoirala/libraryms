<?php
include 'includes/login-check.php';
include 'includes/database.php';

/* Default Location is set here first */
$city="Sydney";
$country="Australia"; 

/*Getting Location info*/
$location_url="http://ip-api.com/json/";
$location_contents=file_get_contents($location_url);
$location_json=json_decode($location_contents,true);

//Assign new location
$city = $location_json['city'];
$country = $location_json['country'];

/* Getting WeatherInfo using location from above */
$url="http://api.openweathermap.org/data/2.5/weather?q=$city,$country&units=metric&cnt=7&lang=en";
$json=file_get_contents($url);
$data=json_decode($json,true);

if($url)
{
	echo $json;
}

/*Get current Temperature in Celsius
echo $data['main']['temp']."<br>";
echo $data['main']['temp_min']."<br>";
//Get weather condition
echo $data['weather'][0]['main'];
//Get cloud percentage
echo $data['clouds']['all'];
//Get wind speed
echo $data['wind']['speed'];
echo $data['main']['humidity'];
*/
?>