<?php

require_once __DIR__ . '../../Interfaces/IDatabase.php';
require_once __DIR__ . '../../Shared/consts.php';


class Database implements IDatabase
{
    // Members
    private $pdo;

    //queris
    
    private $_getCountry="SELECT id FROM countries WHERE Country = :Country";
    
    
    private $_getCountries = "SELECT Country From countries";

    
    private $_insertCountryQuery = "INSERT INTO countries(Country, Slug, ISO2)
                                    VALUES(:Country, :Slug, :ISO2)"; 
    
    private $_insertCassesForCountry="INSERT INTO casses (CountryId, Active, NewConfirmed, TotalConfirmed, NewDeaths, TotalDeaths, NewRecovered, TotalRecovered, CurrentDate)
                                     VALUES (:CountryId, :Active, :NewConfirmed, :TotalConfirmed, :NewDeaths, :TotalDeaths, :NewRecovered, :TotalRecovered, :CurrentDate)";
    
    private $_selectLastDataForCountry="SELECT * FROM casses WHERE CountryID = :Id ORDER BY CurrentDate DESC LIMIT 1";
    
    
    private $_getDailyDataForCountries = "SELECT CountryId, Country, Active, NewConfirmed, TotalConfirmed, NewRecovered, TotalRecovered, NewDeaths, TotalDeaths, MAX(CurrentDate)
                                          FROM countries c
                                          INNER JOIN casses cs
                                          ON c.id = cs.CountryId
                                          GROUP BY Country";
    

    private $_selectDataForCountryWithSpecDate = "SELECT Country, Active, NewConfirmed, TotalConfirmed, NewRecovered, TotalRecovered, NewDeaths, TotalDeaths 
    FROM(
            SELECT CountryId, Country, MAX(CurrentDate) AS MaxData
            FROM countries c
            INNER JOIN casses cs
            ON c.id = cs.CountryId
            WHERE cs.CurrentDate < :current 
            GROUP BY Country
    )r
    LEFT JOIN casses t
        ON t.CountryId = r.CountryId AND t.CurrentDate= r.MaxData";




    private $_selectDataForCountry="SELECT * from countries INNER JOIN  casses ON countries.id=casses.CountryId WHERE Country=:Country AND casses.CurrentDate > :CurrentDate" ;

    // Constructor
    function __construct() {
        try 
        {
            $this->pdo = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSER, DBPASS);
        }
        catch (PDOException $e) 
        {
            header("Location: indext.php");
            die();
        }
    }
    // Methods
    public function InsertCountry($country)
    {
            $stmt = $this->pdo->prepare($this->_getCountry); 
            $stmt->bindValue('Country', $country->Country, PDO::PARAM_STR);
            $stmt->execute();
            $countryId =$stmt->fetch(); 
            if(!$countryId)
            {
                $stmt = $this->pdo->prepare($this->_insertCountryQuery);
                $stmt->bindValue('Country', $country->Country, PDO::PARAM_STR);
                $stmt->bindValue('Slug', $country->Slug, PDO::PARAM_STR);
                $stmt->bindValue('ISO2', $country->ISO2, PDO::PARAM_STR);
                $stmt->execute();

                return $this->pdo->lastInsertId();
            }
            return $countryId;
    }

    public function InsertCassesForCountry($countryId, $casses)
    {
        $data= $this->GetLastInsertedDataForCountry($countryId);


        if(!$data)
        {
            $stmtInsertCases=$this->pdo->prepare($this->_insertCassesForCountry);
            $stmtInsertCases->bindParam('CountryId', $countryId);
            $stmtInsertCases->bindParam('Active', $casses->Active);
            $stmtInsertCases->bindParam('NewConfirmed', $casses->Confirmed);
            $stmtInsertCases->bindParam('TotalConfirmed', $casses->Confirmed);
            $stmtInsertCases->bindParam('NewDeaths', $casses->Deaths);
            $stmtInsertCases->bindParam('TotalDeaths', $casses->Deaths);
            $stmtInsertCases->bindParam('NewRecovered', $casses->Recovered);
            $stmtInsertCases->bindParam('TotalRecovered', $casses->Recovered);
            $stmtInsertCases->bindParam('CurrentDate',$date);  
            $date=date("Y-m-d", strtotime($casses->Date));
            $stmtInsertCases->execute();
        }
        else
        {
            $cassesDate= date("Y-m-d", strtotime($casses->Date));
            $lastInsertedDate= date("Y-m-d", strtotime($data['CurrentDate']));
            if($cassesDate>$lastInsertedDate)
            { 
                $stmtInsertCases=$this->pdo->prepare($this->_insertCassesForCountry);
                $stmtInsertCases->bindParam('CountryId', $countryId);
                $stmtInsertCases->bindParam('Active', $casses->Active);
                $stmtInsertCases->bindParam('NewConfirmed',  $newConfirmed);
                $stmtInsertCases->bindParam('TotalConfirmed', $totalConfimed);
                $stmtInsertCases->bindParam('NewDeaths', $NewDeaths);
                $stmtInsertCases->bindParam('TotalDeaths', $TotalDeaths);
                $stmtInsertCases->bindParam('NewRecovered',$NewRecovered);
                $stmtInsertCases->bindParam('TotalRecovered', $TotalRecovered);
                $stmtInsertCases->bindParam('CurrentDate', $date);  
                $date=date("Y-m-d", strtotime($casses->Date));

                $newConfirmed= $casses->Confirmed - $data['TotalConfirmed'];
                $totalConfimed= $casses->Confirmed;
                $NewDeaths= $casses->Deaths - $data['TotalDeaths'];
                $TotalDeaths= $casses->Deaths;
                $NewRecovered= $casses->Recovered - $data['TotalRecovered'];
                $TotalRecovered= $casses->Recovered; 
                $stmtInsertCases->execute();                                             
            }
            else
            {
                return;
            }

           
        }

   
    }

    public function GetLastInsertedDataForCountry($countryId)
    {
        $stmt = $this->pdo->prepare($this->_selectLastDataForCountry);
        $stmt->bindValue('Id', $countryId, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function GetCountries()
    {

        $pdo = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSER, DBPASS);
        $stmt = $pdo->prepare($this->_getCountries);
        $stmt->execute([]);
        return $stmt->fetchAll();
    }

    public function GetDailyDataForCountries()
    {        
        $pdo = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSER, DBPASS);
        $stmt = $pdo->prepare($this->_getDailyDataForCountries);
        $stmt->execute([]);
        return $stmt->fetchAll();
    }

    public function GetDataFor($period)
    {    
        $currentDate = date("Y-m-d");
        $periodDate = date("Y-m-d", strtotime(strval(-$period). " months"));

        $stmt = $this->pdo->prepare($this->_selectDataForCountryWithSpecDate);
        $stmt->bindValue('current', $currentDate, PDO::PARAM_STR);
        $stmt->execute();
        $todayInfo = $stmt->fetchAll();

        $stmt = $this->pdo->prepare($this->_selectDataForCountryWithSpecDate);
        $stmt->bindValue('current', $periodDate, PDO::PARAM_STR);
        $stmt->execute();
        $periodInfo = $stmt->fetchAll();

        foreach($todayInfo as &$countryData)
        {
            foreach($periodInfo as $countryPeriod)
            {
                if($countryData["Country"] == $countryPeriod["Country"])
                {
                    $Active =  $countryData["Active"] - $countryPeriod["Active"];
                    $NewConfirmed =  $countryData["NewConfirmed"] - $countryPeriod["NewConfirmed"];
                    $TotalConfirmed =  $countryData["TotalConfirmed"]- $countryPeriod["TotalConfirmed"];
                    $NewRecovered =  $countryData["NewRecovered"]- $countryPeriod["NewRecovered"];
                    $TotalRecovered =  $countryData["TotalRecovered"]- $countryPeriod["TotalRecovered"];
                    $NewDeaths =  $countryData["NewDeaths"]- $countryPeriod["NewDeaths"];
                    $TotalDeaths =  $countryData["TotalDeaths"]- $countryPeriod["TotalDeaths"];


                    $countryData["Active"] = $Active;
                    $countryData["NewConfirmed"] = $NewConfirmed;
                    $countryData["TotalConfirmed"] =$TotalConfirmed; 
                    $countryData["NewRecovered"] = $NewRecovered;
                    $countryData["TotalRecovered"] = $TotalRecovered ;
                    $countryData["NewDeaths"] = $NewDeaths;
                    $countryData["TotalDeaths"]= $TotalDeaths;                     
                }                
            }                
        }

        return $todayInfo;
    }
    public function GetDataForCountry($country)
    {
        $periodDate = date("Y-m-d", strtotime("-3 months"));
        $pdo = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSER, DBPASS);
        $stmt = $pdo->prepare($this->_selectDataForCountry);        
        $stmt->bindValue('Country', $country, PDO::PARAM_STR);
        $stmt->bindValue('CurrentDate', $periodDate, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();        
    }
}

?>