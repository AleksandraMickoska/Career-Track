<?php

require_once __DIR__ . '/Shared/consts.php';
require_once __DIR__ . '/Services/CovidAPI.php';
require_once __DIR__ . '/Services/Database.php';


class Service 
{
    private $startingDate = "2021-01-01";

    // Members
    private ICovidAPI $_covidApi;
    private IDatabase $_database; 
  
    // Constructor
    public function __construct($covidApi,$database) 
    {
        $this->_covidApi = $covidApi;
        $this->_database = $database;
    }

    public function RunInsertation()
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


$service = new Service(new CovidAPI(),new Database());
$service->RunInsertation();


?>