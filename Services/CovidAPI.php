<?php

require_once __DIR__ . '../../Interfaces/ICovidAPI.php';

class CovidAPI implements ICovidAPI
{
    // Methods
    public function GetCountries()
    {
        $getCountries = file_get_contents("https://api.covid19api.com/countries");
         return json_decode($getCountries);        
    }

    public function GetDataByCountry($countrySlug, $startingDate, $endingDate)
    {        
        $apiCall  = "https://api.covid19api.com/country/{$countrySlug}?from=".$startingDate."&to=".$endingDate;

        $getCountrieDate = file_get_contents($apiCall);
        return json_decode($getCountrieDate);        
    }


}
?>