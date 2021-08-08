$(document).ready(function(){

  // $(window).on(function(){
     GetCountres();
    GetDailyDataForCountries();
  // })
});
  
  
  
  function GetCountres() {
    var data = new FormData();
    data.append("method", "getCountries");

    var xtmlRequest = new XMLHttpRequest();
    xtmlRequest.open("POST","functions.php");
    xtmlRequest.onload = function()
    {
      insertCountres(this.response)
    };
    xtmlRequest.send(data);
    return false;
  }

function insertCountres(response)
{
    var responseStr = JSON.parse(response)

    responseStr.data.forEach(element => {
      
      $("#selectCountry").append($('<option>',{value:element["Country"].toString(),text:element["Country"].toString()}));
      console.log(element["Country"]);  
    });
}

function GetDailyDataForCountries() {
  var data = new FormData();
  data.append("method", "GetDailyDataForCountries");

  var xtmlRequest = new XMLHttpRequest();
  xtmlRequest.open("POST","functions.php");
  xtmlRequest.onload = function()
  {
    insertTable(this.response)
  };
  xtmlRequest.send(data);
  return false;
}


function GetDataForPeriod($months) {
  var data = new FormData();
  data.append("method", "GetDataForPeriod");
  data.append("period",$months);

  var xtmlRequest = new XMLHttpRequest();
  xtmlRequest.open("POST","functions.php");
  xtmlRequest.onload = function()
  {
    insertTable(this.response)
  };
  xtmlRequest.send(data);
  return false;
}




function insertTable(response)
{
  var responseStr = JSON.parse(response)
  var AllTotalConfirmed = 0;
  var AllTotalRecovered = 0;
  var AllTotalDeaths = 0;

  $("#countriesData").empty();

  responseStr.data.forEach(element => {
    
    var Country =  element["Country"]
    var Active =  element["Active"]
    var NewConfirmed =  element["NewConfirmed"]
    var TotalConfirmed =  element["TotalConfirmed"]
    var NewRecovered =  element["NewRecovered"]
    var TotalRecovered =  element["TotalRecovered"]
    var NewDeaths =  element["NewDeaths"]
    var TotalDeaths =  element["TotalDeaths"]

    AllTotalConfirmed+=parseInt(TotalConfirmed)
    AllTotalRecovered+=parseInt(TotalRecovered)
    AllTotalDeaths+=parseInt(TotalDeaths)

    $("#countriesData")
    .append('<tr><td>'+Country+'</td><td>'+Active+'</td><td>'+NewConfirmed+'</td><td>'+TotalConfirmed+'</td><td>'+NewRecovered+'</td><td>'+TotalRecovered+'</td><td>'+NewDeaths+'</td><td>'+TotalDeaths+'</td></tr>');
  });

  $('#totalCases').html(AllTotalConfirmed);
  $('#recoveredNumber').html(AllTotalRecovered);
  $('#deathsNumber').html(AllTotalDeaths);
}


function changeCountry() {
  var country=$("#selectCountry").val();
  var data = new FormData();
  data.append("method", "GetDataForCountry");
  data.append("country",country);

  var xtmlRequest = new XMLHttpRequest();
  xtmlRequest.open("POST","functions.php");
  xtmlRequest.onload = function()
  {
    insertCountryTable(this.response)    
  };
  xtmlRequest.send(data);
  return false;
}

function insertCountryTable(response)
{
  var responseStr = JSON.parse(response) 

  $("#specificCountryTable").empty();

  $("#specificCountryTable")
  .append('<tr class="m-3 m-5"><th>Country</th><th>Active cases</th><th>New confirmed</th><th>Total Confirmed</th><th>New Recovered</th><th >Total Recovered</th><th>New deaths</th><th>Total deaths</th></tr> ');   

  responseStr.data.forEach(element => {    
    
    var Country =  element["Country"]
    var Active =  element["Active"]
    var NewConfirmed =  element["NewConfirmed"]
    var TotalConfirmed =  element["TotalConfirmed"]
    var NewRecovered =  element["NewRecovered"]
    var TotalRecovered =  element["TotalRecovered"]
    var NewDeaths =  element["NewDeaths"]
    var TotalDeaths =  element["TotalDeaths"]

    $("#specificCountryTable")
    .append('<tr><td>'+Country+'</td><td>'+Active+'</td><td>'+NewConfirmed+'</td><td>'+TotalConfirmed+'</td><td>'+NewRecovered+'</td><td>'+TotalRecovered+'</td><td>'+NewDeaths+'</td><td>'+TotalDeaths+'</td></tr>');
  });
}



