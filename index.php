<?php

    require_once "./Services/SyncService.php";
    require_once "./Services/Database.php";
    require_once "./Services/CovidAPI.php";
    ?>


<!doctype html>
<html lang="en">
  <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="index.js"></script>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

        <!--  CSS -->
        <link href="index.css" rel="stylesheet">
        <title>PROJECT 2 - COVID TRACKER</title>
  </head>
  <body>
        <!--Getting data for each country in the main table is made by loading the page  -->
        <!-- Syncing is having problems when it comes to USA-->

        <div class="container-fluid">
            <!--Navigation bar-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
                <div class="container-fluid">
                  <a class="navbar-brand" href="index.php">
                      <img  id="logo" src="./assets/logoCovid.png" class="border border-danger rounded-5">
                  </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">                
                        <a class="nav-link btn border border-info m-1" aria-current="page" href="index.php">HOME</a>
                        <form method="POST">
                        <button id="sync" name = "sync" value = "sync" type = "submit" class="btn nav-link border border-danger text-danger"  >SYNC</button>
                        </form>
                  </div>
                </div>
            </nav>
            <!--First part-shows global data-->
            <div id="firstPart" class="text-center text-white border border-white rounded-3 shadow">
                <h1 class="p-3 border border-white rounded-3 shadow-lg">COVID TRACKER</h1>
                <div class="row m-3 p-3 mt-5">
                    <div class="col-lg-4 col-md-4 col-sm-4 mt-5">
                        <h2 class="p-2 border border-white rounded-3">Total Cases</h2>
                        <h2 id="totalCases" class="text-warning fw-bold bg-light rounded-3"></h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 mt-5">
                        <h2 class="p-2 border border-white rounded-3">Recovered</h2>
                        <h2 id="recoveredNumber" class="text-success fw-bold bg-light rounded-3"></h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 mt-5">
                        <h2 class="p-2 border border-white rounded-3">Deaths</h2>
                        <h2 id="deathsNumber" class="text-danger fw-bold bg-light rounded-3"></h2>
                    </div>
                </div>            
            </div>
           
            <div id="statistics" class="row text-center text-info m-3 p-2">
                
                
                 <div class="col-lg-12 col-md-4 col-sm-12">
                    <p>Displayed results are daily and global</p>
                    <button id="dailyGlobal" class="btn-lg border border-info rounded-3 text-white bg-info shadow m-3">Daily</button>
                     <button id="oneMonthGlobal" onclick="GetDataForPeriod(1)" class="btn-lg border border-info rounded-3 text-white bg-info shadow m-3">1 MONTH</button>
                    <button id="threeMonthsGlobal" onclick="GetDataForPeriod(3)" class="btn-lg border border-info rounded-3 text-white bg-info shadow m-3">3 MONTHS</button>
                 </div>  
                
                <table class="col-12 border border-info rounded-3 shadow table-bordered table table-striped">
                    <thead>
                        <h4 class="mb-3 p-3 border border-info rounded-3 shadow">COVID 19 STATISTICS</h4>
                        <tr class="m-3 m-5">
                            <th>Country</th>
                            <th>Active cases</th>
                            <th>New confirmed</th>
                            <th>Total Confirmed</th>                        
                            <th>New Recovered</th>                           
                            <th >Total Recovered</th>
                            <th>New deaths</th>       
                            <th>Total deaths</th>                      
                        </tr>
                    </thead>
                    <tbody id = "countriesData">
                        
                    </tbody>                              
                </table>
                 <!--Second part - shows table with each country chosen and table with
                 all countries daily, for 1 mont or 3 months-->
                <div class="col-lg-12 col-md-4 col-sm-12">
                    <div class="row text-center">
                         <h3 class="m-3">Choose country to see statistics:</h3>
                            <select onchange="changeCountry()" class="form-select col-6" id ="selectCountry"  aria-label="Default select example">
                                <option  selected>Choose country</option>
                            </select>
                            <button id="dailyCountry" class="col-2 btn border border-info rounded-3 text-white bg-info shadow m-3">Daily</button>
                            <button id="oneMonthCountry" class="col-2 btn border border-info rounded-3 text-white bg-info shadow m-3">1 MONTH</button>
                            <button id="threeMonthsCountry"class=" col-2 btn border border-info rounded-3 text-white bg-info shadow m-3">3 MONTHS</button>
                                
                    </div>                                            
                </div>       
                 <table id="specificCountryTable" class="col-12 border border-info rounded-3 shadow table-bordered table table-striped">
                 
                   <h4 class="mb-3 p-3 border border-info rounded-3 shadow">STATISTICS FOR THE COUNTRY YOU CHOOSE</h4>
                
                 </table>
            </div>
            <footer class="text-center bg-secondary text-white border border-white">
                <p class="pt-3 mt-3">Designed by Aleksandra Mickoska</p>
                <div class="text-center">
                    <a class="text-white m-">Facebook</a>
                    <a class="text-white m-3">LinkedIn</a>
                    <a class="text-white">Twitter</a>
                </div>
                <hr>
                <p>Copyright Worldometers.info</p>
            </footer>
        </div>


        <!--Buttons used for syncing-->
        <!--<button><a onclick='GetCountres()' class="deletebtn">SyncData</a></button>
        <button><a onclick='GetDailyDataForCountries()' class="deletebtn">InsertTable</a></button>-->
       

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> -->
        <!-- Option 1: Bootstrap Bundle with Popper -->

  </body>
</html>