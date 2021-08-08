<?php
interface ICovidAPI 
{
    // return all the countryes with covid cases 
    public function GetCountries();

    // return all data for specified country in specified time window 
    public function GetDataByCountry($countryName,$startingDate,$endingDate);
}
?>