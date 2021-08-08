<?php
interface IDatabase 
{
    //insert functions

    // will insert one country by call (if is not inserted) 
    public function InsertCountry($country);

    // will insert casses for one country for one date
    public function InsertCassesForCountry($countryId,$casses);


    //get functions

    // will get latest inserted data with data for specified country(countryId)
    public function GetLastInsertedDataForCountry($countryId);

    // will return all countryes in your database
    public function GetCountries();

}
?>