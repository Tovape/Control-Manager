<?php

// Get System Language

function sysLanguageFunction() {
	exec('cmd /c .\bat\sysLanguage.bat 2>&1', $sysLanguageoutput, $sysLanguagesvalue);

	if (strpos(json_encode($sysLanguageoutput), "0409") !== false) {
		return "English";
	} else if (strpos(json_encode($sysLanguageoutput), "0C0A") !== false) {
		return "Spanish";
	} else if (strpos(json_encode($sysLanguageoutput), "040C") !== false) {
		return "French";
	} else if (strpos(json_encode($sysLanguageoutput), "0410") !== false) {
		return "Italian";
	} else if (strpos(json_encode($sysLanguageoutput), "041D") !== false) {
		return "Swedish";
	} else if (strpos(json_encode($sysLanguageoutput), "0813") !== false) {
		return "Dutch";
	} else if (strpos(json_encode($sysLanguageoutput), "0816") !== false) {
		return "Portuguese";
	} else if (strpos(json_encode($sysLanguageoutput), "0416") !== false) {
		return "Brazilian";
	} else if (strpos(json_encode($sysLanguageoutput), "040B") !== false) {
		return "Finnish";
	} else if (strpos(json_encode($sysLanguageoutput), "0414") !== false) {
		return "Norwegian";
	} else if (strpos(json_encode($sysLanguageoutput), "0406") !== false) {
		return "Danish";
	} else if (strpos(json_encode($sysLanguageoutput), "040E") !== false) {
		return "Hungarian";
	} else if (strpos(json_encode($sysLanguageoutput), "0415") !== false) {
		return "Polish";
	} else if (strpos(json_encode($sysLanguageoutput), "0419") !== false) {
		return "Russian";
	} else if (strpos(json_encode($sysLanguageoutput), "0405") !== false) {
		return "Czech";
	} else if (strpos(json_encode($sysLanguageoutput), "0408") !== false) {
		return "Greek";
	} else if (strpos(json_encode($sysLanguageoutput), "041F") !== false) {
		return "Turkish";
	} else if (strpos(json_encode($sysLanguageoutput), "0411") !== false) {
		return "Japanese";
	} else if (strpos(json_encode($sysLanguageoutput), "0412") !== false) {
		return "Korean";
	} else if (strpos(json_encode($sysLanguageoutput), "0407") !== false) {
		return "German";
	} else if (strpos(json_encode($sysLanguageoutput), "0804") !== false) {
		return "Chinese (Simplified)";
	} else if (strpos(json_encode($sysLanguageoutput), "0404") !== false) {
		return "Chinese (Traditional)";
	} else if (strpos(json_encode($sysLanguageoutput), "0401") !== false) {
		return "Arabic";
	} else if (strpos(json_encode($sysLanguageoutput), "040d") !== false) {
		return "Hebrew";
	} else {
		return "Language Not Found";
	}

}

// Get System hostname

function sysHostnameFunction() {
	$hostName = "n";
	return php_uname($hostName);
}

// Get System Operative System 

function sysOSFunction() {
	$osName = "s";
	exec('cmd /c .\bat\sysOsversion.bat 2>&1', $machineOsversionoutput, $machineOsversionvalue);
	$sysOSreturn = php_uname($osName). " ".$machineOsversionoutput[1];
	return $sysOSreturn;
}

// Get System Manufacturer

function sysManufacturerFunction() {
	exec('cmd /c .\bat\sysManufacturer.bat 2>&1', $sysManufactureroutput, $sysManufacturervalue);	
	return $sysManufactureroutput[1];
}

// Get System Product

function sysProductFunction() {
	exec('cmd /c .\bat\sysProduct.bat 2>&1', $sysProductoutput, $sysProductvalue);	
	return $sysProductoutput[1];
}

// Get System BIOS

function sysBiosFunction() {
	exec('cmd /c .\bat\sysBios.bat 2>&1', $sysBiosoutput, $sysBiosvalue);
	return $sysBiosoutput[1];
}

// Browser Language

function sysBLFunction() {
	return $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
}

// Get System CPU Name

function sysCpunameFunction() {
	exec('cmd /c .\bat\cpuName.bat 2>&1', $cpuNameoutput, $cpuNamevalue);
	return $cpuNameoutput[1];
}
	
// Get System CPU Cores

function sysCpucoresFunction() {
	exec('cmd /c .\bat\cpuNumberofcores.bat 2>&1', $cpuNumberofcoresoutput, $cpuNumberofcoresvalue);
	return $cpuNumberofcoresoutput[1];
}

// Get System Cpu Max Clock Speed

function sysMCSFunction() {
	exec('cmd /c .\bat\cpuMaxclockspeed.bat 2>&1', $sysMCSoutput, $sysMCSvalue);
	return $sysMCSoutput[1]." hz";
}

// Get System Cpu Caption

function sysCpucaptionFunction() {
	exec('cmd /c .\bat\cpuCaption.bat 2>&1', $sysCpucaptionoutput, $sysCpucaptionvalue);
	return $sysCpucaptionoutput[1];
}

// Get System Cpu Architecture

function sysCpuarchitectureFunction() {

$osType = "m";

	if (strpos(php_uname($osType), '64') !== false) {
		return "x64<br>";
	}

	if (strpos(php_uname($osType), '32') !== false) {
		return "x32<br>";
	}

}

// Get System Ram Slots Count

function sysRamslotFunction() {
	
	$ramslotcount=0;
	
	exec('cmd /c .\bat\ramType.bat 2>&1', $ramTypeoutput, $ramTypevalue);
	
	for ($i = 0; $i < sizeof($ramTypeoutput); $i++) {
		if ($ramTypeoutput[$i] == "20") {
			$ramslotcount++;
		} else if ($ramTypeoutput[$i] == "21") {
			$ramslotcount++;
		} else if ($ramTypeoutput[$i] == "22") {
			$ramslotcount++;
		} else if ($ramTypeoutput[$i] == "24") {
			$ramslotcount++;
		} else if ($ramTypeoutput[$i] == "26") {
			$ramslotcount++;
		}
	}
	
	return $ramslotcount;
	
}

// Get System Ram Slots

function sysRamddrtypeFunction() {
	exec('cmd /c .\bat\ramType.bat 2>&1', $ramTypeoutput, $ramTypevalue);

	for ($i = 0; $i < sizeof($ramTypeoutput); $i++) {
		if ($ramTypeoutput[$i] == "20") {
			return "DDR";
		} else if ($ramTypeoutput[$i] == "21") {
			return "DDR2";
		} else if ($ramTypeoutput[$i] == "22") {
			return "DDR2 FB-DIMM";
		} else if ($ramTypeoutput[$i] == "24") {
			return "DDR3";
		} else if ($ramTypeoutput[$i] == "26") {
			return "DDR4";
		}
	}
}

// Get System Ram Factor

function sysRamfactortypeFunction() {
	exec('cmd /c .\bat\ramFormfactor.bat 2>&1', $sysRamfactortypeoutput, $sysRamfactortypevalue);
	
	for ($i = 0; $i < sizeof($sysRamfactortypeoutput); $i++) {
		if ($sysRamfactortypeoutput[$i] == "8") {
			return "DIMM";
		} else if ($sysRamfactortypeoutput[$i] == "12") {
			return "SODIMM";
		}
	}

}

// Get System Battery Percentage

function sysBatterynumberFunction() {
	exec('cmd /c .\bat\sysBattery.bat 2>&1', $sysBatteryoutput, $sysBatteryvalue);
	return $sysBatteryoutput[1];
}

// Get System Battery Color

function sysBatterycolorFunction() {
	exec('cmd /c .\bat\sysBattery.bat 2>&1', $sysBatteryoutput, $sysBatteryvalue);
		
	if ($sysBatteryoutput[1] <= 20) {
		return $sysBatteryoutput[1]."%;background-color: #ff2e2e";
	} else if ($sysBatteryoutput[1] > 20 && $sysBatteryoutput[1] <= 40) {
		return $sysBatteryoutput[1]."%;background-color: #fb7901";
	} else if ($sysBatteryoutput[1] > 40 && $sysBatteryoutput[1] <= 60) {
		return $sysBatteryoutput[1]."%;background-color: #f5ca01";
	} else if ($sysBatteryoutput[1] > 60 && $sysBatteryoutput[1] <= 80) {
		return $sysBatteryoutput[1]."%;background-color: #84c300";
	} else if ($sysBatteryoutput[1] > 80 && $sysBatteryoutput[1] <= 100) {
		return $sysBatteryoutput[1]."%;background-color: #00bf00";
	}
}

// Get System Ram Size in GB

function sysRamSizeFunction() {
	
	$ramCapacity=0;
	
	exec('cmd /c .\bat\ramCapacity.bat 2>&1', $sysRamSizeoutput, $sysRamSizevalue);
	
	unset($sysRamSizeoutput[0]);
	
	for ($i = 1; $i < sizeof($sysRamSizeoutput); $i++) {
		$ramCapacity = $ramCapacity + $sysRamSizeoutput[$i];
	}

	$ramCapacity = $ramCapacity/1073741824;
	
	return $ramCapacity." GB";

}

// Get Media Storage

function sysMediaFunction() {
	exec('cmd /c .\bat\sysMediamodel.bat 2>&1', $sysMediamodeloutput, $sysMediamodelvalue);
	exec('cmd /c .\bat\sysMediamediatype.bat 2>&1', $sysMediamediatypeoutput, $sysMediamediatypevalue);
	exec('cmd /c .\bat\sysMedianame.bat 2>&1', $sysMedianameoutput, $sysMedianamevalue);
	exec('cmd /c .\bat\sysMediasize.bat 2>&1', $sysMediasizeoutput, $sysMediasizevalue);	
	exec('cmd /c .\bat\sysMediamanufacturer.bat 2>&1', $sysMediamanufactureroutput, $sysMediamanufacturervalue);
	exec('cmd /c .\bat\sysMediaserialnumber.bat 2>&1', $sysMediaserialnumberoutput, $sysMediaserialnumbervalue);
	exec('cmd /c .\bat\sysMediainterfacetype.bat 2>&1', $sysMediainterfacetypeoutput, $sysMediainterfacetypevalue);
				
	for ($i = 1; $i < sizeof($sysMedianameoutput)-1; $i++) {
		
		echo "<div class='system-table'>";
		echo "<table>";
		echo "<tr>";
		echo "<th colspan='100%'>Media Device</th>";
		echo "</tr>";	
		echo "<tr>";
		echo "<td>Model</td>";
		echo "<td>".$sysMediamodeloutput[$i]."</td>";
		echo "</tr><tr>";
		echo "<td>MediaType</td>";
		echo "<td>".$sysMediamediatypeoutput[$i]."</td>";
		echo "</tr><tr>";
		echo "<td>Name</td>";
		echo "<td>".$sysMedianameoutput[$i]."</td>";
		echo "</tr><tr>";
		echo "<td>Size</td>";		
		echo "<td>".number_format((float)($sysMediasizeoutput[$i]/1073741824), 2, '.', '')." GB</td>";
		echo "</tr><tr>";
		echo "<td>Manufacturer</td>";
		echo "<td>".$sysMediamanufactureroutput[$i]."</td>";
		echo "</tr><tr>";
		echo "<td>Serial Number</td>";
		echo "<td>".$sysMediaserialnumberoutput[$i]."</td>";
		echo "</tr><tr>";
		echo "<td>Interface Type</td>";
		echo "<td>".$sysMediainterfacetypeoutput[$i]."</td>";
		echo "</tr></table></div>";
	}
}

?>