<?php

require_once __DIR__ . '../../Interfaces/IDatabase.php';
require_once __DIR__ . '../../Interfaces/ICovidAPI.php';
require_once __DIR__ . '../../Interfaces/ISyncService.php';


class SyncService
{

    private $startingDate = "2021-01-01";

    // Members
    private  $_covidApi;
    private  $_database; 
  
    // Constructor
    public function __construct($covidApi,$database) 
    {
        $this->_covidApi = $covidApi;
        $this->_database = $database;
    }

    public function SyncDatabase()
    {
        foreach ($this->_covidApi->GetCountries() as $country) 
        {
            $countrId =  $this->_database->InsertCountry($country);
            $lastDateInesrtation = $this->_database->GetLastInsertedDataForCountry($countrId);            
            if(!$lastDateInesrtation)
            {
                $currentDate = date("Y-m-d");
                $CountryData = $this->_covidApi->GetDataByCountry($country->Slug, $this->startingDate, $currentDate);
                
                foreach($CountryData as $data)
                {
                    $this->_database->InsertCassesForCountry($countrId,$data);
                }
            }
            else
            {
                $currentDate = date("Y-m-d");
                $CountryData = $this->_covidApi->GetDataByCountry($country->Slug,$lastDateInesrtation['CurrentDate'],$currentDate);              
            }
        }
    }
}
?>