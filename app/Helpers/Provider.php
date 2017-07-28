<?php

namespace App\Helpers;

class Provider {

    protected $countryProviderMap = [
        'UG' => 'hoteliug',
        'RW' => 'hoteri',
        'TZ' => 'hotelitz',
        'NG' => 'hotelsng',
        'GH' => 'hotedigh',
        'KE' => 'hotelike',
    ];

    protected $providerCodeCountryMap = [
        'UGANDA'   => 'UG',
        'RWANDA'   => 'RW',
        'KENYA'    => 'KE',
        'GHANA'    => 'GH',
        'NIGERIA'  => 'NG',
        'TANZANIA' => 'TZ',
    ];

    protected $providerUuidMap = [
        'hoteliug'  => '880595a3-9f84-4b7c-87de-6fe7c981f5ee',
        'hoteri'    => 'c599786a-bcc0-4afb-9a66-82dd61b54b0b',
        'hotelitz'  => 'a81a2d2b-a82e-485b-b7b1-d7c22d0ab7bf',
        'hotelsng'  => 'a965ed6e-c292-4263-b4de-d01057984441',
        'hotedigh'  => '88d5cfa0-6a0c-439f-a608-b930bd81d978',
        'hotelike'  => '831203f7-259c-4cc7-b7f3-902fd5a6f108',
    ];

    protected $providerCountryURLMap = [
        'UG' => 'http://hoteli.ug',
        'RW' => 'http://hoteri.rw',
        'KE' => 'http://hoteli.co.ke',
        'GH' => 'http://hotedi.com.gh',
        'NG' => 'https://hotels.ng',
        'TZ' => 'http://hoteli.co.tz',
    ];

    /**
     * Get the provider URL from the country name.
     *
     * @param  string  $name
     * @param  boolean $useCountryCode
     * @return string|false
     */
    public function getProviderUrlFromCountry($name, $useCountryCode = false, $default = false)
    {
        $countryCode = $useCountryCode ? strtoupper($name) : $this->countryNameToCode($name);

        return array_get($this->providerCountryURLMap, $countryCode, false);
    }

    /**
     * Get the provider name from the country code or name.
     *
     * @param  string  $name
     * @param  boolean $useCountryCode
     * @param  mixed   $default
     * @return string
     */
    public function getProviderNameFromCountry($name, $useCountryCode = false, $default = 'expedia')
    {
        $countryCode = $useCountryCode ? strtoupper($name) : $this->countryNameToCode($name);

        return array_get($this->countryProviderMap, $countryCode, $default);
    }

    /**
    * Get Provider Uuid from name
    *
    * @param string $name
    * @return string|false 
    */
    public function getProviderUuidFromName($name)
    {
        return array_get($this->providerUuidMap, $name, false);
    }

    /**
     * Get provider URL from the providers name.
     *
     * @param  string $name
     * @return string|false
     */
    public function getProviderUrlFromProviderName($name)
    {
        foreach ($this->countryProviderMap as $countryCode => $providerName) {
            if (strtolower($providerName) === strtolower($name)) {
                return $this->getProviderUrlFromCountry($countryCode, true);
            }
        }

        return false;
    }

    /**
     * Get the country code from the name of the country.
     * @param  string $name
     * @return string|false
     */
    protected function countryNameToCode($name)
    {
       return array_get($this->providerCodeCountryMap, strtoupper($name));
    }

    public function getValidCountries()
    {
        $validCountries = [];

        foreach ($this->providerCodeCountryMap as $countryName => $countryCode) {
            $country = ['country_name' => $countryName, 
                        'country_code' => $countryCode];
            $country['provider'] = $this->getProviderNameFromCountry($countryName);
            array_push($validCountries, $country);
        }
        
        return $validCountries;
    }
}