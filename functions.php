<?php

require_once './Services/Database.php';


echo $_POST['method']();

function getCountries()
{
  $database = new Database();
  $return = new stdClass();
  $return->success = true;
  $return->errorMessage = "";
  $return->data = $database->GetCountries(); 
  $json = json_encode($return);
  return $json;
}

function GetDailyDataForCountries()
{
  $database = new Database();
  $return = new stdClass();
  $return->success = true;
  $return->errorMessage = "";
  $return->data = $database->GetDailyDataForCountries(); 
  $json = json_encode($return);
  return $json;
}

function GetDataForPeriod()
{
  $period =  $_POST['period'];
  $database = new Database();
  $return = new stdClass();
  $return->success = true;
  $return->errorMessage = "";
  $return->data = $database->GetDataFor($period); 
  $json = json_encode($return);
  return $json;
}

function GetDataForCountry()
{
  $country= $_POST['country'];
  $database = new Database();
  $return = new stdClass();
  $return->success = true;
  $return->errorMessage = "";
  $return->data = $database->GetDataForCountry($country); 
  $json = json_encode($return);
  return $json;
}


