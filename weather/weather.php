<?php

//https://openweathermap.org/api/one-call-api
//https://openweathermap.org/weather-conditions

function weather() {
	
	// Get Day / Night
	
	$hour = date('H');
		
	if ($hour >= 21) {
		$dayStatus = "weather-night";
		$dayText = "Night";
	} else if ($hour >= 7) {
		$dayStatus = "weather-day";
		$dayText = "Day";
	}
		
	// Get Weather
	
	$apiKey = "0c6c7437dc3965467da9bf26b092f8d2";
	$lat = "41.390205";
	$lon = "2.154007";
	$apiUrl = "http://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&lon=".$lon."&units=metric&exclude=hourly,minutely,current&lang=en&appid=" . $apiKey;
	$weather = file_get_contents($apiUrl);
	$weatherContent = json_decode($weather, true);

	foreach($weatherContent['daily'] as $weatherEach) {

		echo "<div class='weather-each ".$dayStatus."-back'>";
		
			echo "<div class='weather-each-banner'>";
				echo "<p class='weather-each-day'>".$dayText."</p>";
				echo "<img src='http://openweathermap.org/img/wn/".$weatherEach['weather'][0]['icon'].".png'>";
			echo "</div>";
			
			echo "<p class='weather-each-date'>".gmdate("d \\o\\f F", $weatherEach['dt'])."</p>";
			echo "<p class='weather-each-temp'>".$weatherEach['temp']['day']."°</p>";
			echo "<p class='weather-each-location'>Barcelona</p>";
			
			echo "<div class='weather-each-spec'>";
				echo "<div class='weather-each-spec-each'>";
					echo "<p class='weather-each-spec-title'>Humidity</p>";
					echo "<p class='weather-each-spec-desc'>".$weatherEach['humidity']."<span>%</span></p>";
				echo "</div>";
				
				echo "<div class='weather-each-spec-each'>";
					echo "<p class='weather-each-spec-title'>Wind</p>";
					
					if ($weatherEach['wind_speed'] < 15) {
						echo "<p class='weather-each-spec-desc weather-low'>".$weatherEach['wind_speed']."<span>km/h</span></p>";
					} else if ($weatherEach['wind_speed'] >= 15 && $weatherEach['wind_speed'] < 30) {
						echo "<p class='weather-each-spec-desc weather-medium'>".$weatherEach['wind_speed']."<span>km/h</span></p>";
					} else if ($weatherEach['wind_speed'] >= 30) {
						echo "<p class='weather-each-spec-desc weather-high'>".$weatherEach['wind_speed']."<span>km/h</span></p>";
					}
					
				echo "</div>";
			
				echo "<div class='weather-each-spec-each'>";
					echo "<p class='weather-each-spec-title'>Status</p>";
					
					if ($weatherEach['weather'][0]['main'] == 'Rain') {
						echo "<p class='weather-each-spec-desc weather-rain'>".$weatherEach['weather'][0]['main']."</p>";
					} else if ($weatherEach['weather'][0]['main'] == 'Clouds') {
						echo "<p class='weather-each-spec-desc weather-clouds'>".$weatherEach['weather'][0]['main']."</p>";
					} else if ($weatherEach['weather'][0]['main'] == 'Thunderstorm') {
						echo "<p class='weather-each-spec-desc weather-thunder'>".$weatherEach['weather'][0]['main']."</p>";
					} else {
						echo "<p class='weather-each-spec-desc'>".$weatherEach['weather'][0]['main']."</p>";
					}
					
				echo "</div>";										
			echo "</div>";
			
			echo "<div class='weather-each-svg ".$dayStatus."'>";
			echo 	"<svg data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'>";
			echo 		"<path d='M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z' class=".$dayStatus."></path>";
			echo 	"</svg>";
			echo "</div>";
		echo '</div>';
		
	}
}
		
?>
