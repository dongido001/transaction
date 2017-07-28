<?php
namespace App\Helpers;

use Illuminate\Http\JsonResponse;

/**
* The Utilties Class for Helper functions
*/
class Utilities
{
	public static function format_response($response){
		return json_decode(json_encode($response), true);
	}

	public static function buildGetURLWithParams($url, $param_array = [])
	{
	    if ($param_array && is_array($param_array)) {
	        $params = http_build_query($param_array);
	        $url = $url . '?' . $params;
	    }

	    return $url;
	}

	public static function sendJson($data){
		return new JsonResponse($data);
	}

	public static function getBanks(){
		return ['FIRST CITY MONUMENT BANK PLC', 'UNITY BANK PLC', 'STANBIC IBTC BANK PLC', 'STERLING BANK PLC', 'Aso Savings and Loans', 'ACCESS BANK NIGERIA', 'AFRIBANK NIGERIA PLC', 'DIAMOND BANK PLC', 'ECOBANK NIGERIA PLC', 'ENTERPRISE BANK LIMITED', 'FIDELITY BANK PLC', 'FIRST BANK PLC', 'GTBANK PLC', 'HERITAGE BANK', 'KEYSTONE BANK PLC', 'SKYE BANK PLC', 'STANDARD CHARTERED BANK NIGERIA LIMITED', 'UNION BANK OF NIGERIA PLC', 'UNITED BANK FOR AFRICA (UBA) PLC', 'WEMA BANK PLC', 'ZENITH BANK PLC'];
	}

	// NB- You should change to use cookies
	public static function setDefaultCountry($country){
		$country = explode('__', $country);

		$_SESSION['default_country_code'] = $country_code = $country[0];
		$_SESSION["default_country_name"] = $country_name = $country[1];
		$_SESSION["default_provider"] = $provider = strtolower($country[2]);
		
		// setcookie("default_country_code", strtolower($country_code), time() + (86400 * 30 * 7), "/"); // 7 days

		// setcookie("default_country_name", ucwords($country_name), time() + (86400 * 30 * 7), "/"); // 7 days

		// setcookie("default_provider", $provider, time() + (86400 * 30 * 7), '/'); //7 days

		return redirectTo($_SERVER["HTTP_REFERER"]);
	}
}
