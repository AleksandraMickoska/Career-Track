<?php
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $companyName = $_POST['companyName'];
    $telephone = $_POST['telephone'];
    $selected = $_POST['studentType'];


    $db = mysqli_connect("localhost","id16124386_brainsterlabs",'o?X\6-nnD<FHI<Lt',"id16124386_brainster_labs");
    $db->set_charset('utf8');
    $query = "INSERT INTO studentapplication (FullName,CompanyName,Email,Telephone,StudentType)
    VALUES ('$fullName','$companyName','$email','$telephone','$selected')";
    mysqli_query($db,$query);

    echo ' 
   <!doctype html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <title>Завршена апликација!</title>
        <style> 
          .container-fluid{
            background-image: linear-gradient(to bottom left, black, #ffcc00);
            height:100vh;
          }
          img {
            width:20vw;
            height:20vh;
          }
        </style>
      </head>
      <body>
        <div class="container-fluid p-5 text-center d-flex justify-content-center flex-column align-items-center> 
          <div class= border border-dark bg-info p-5 "> 
            <p class="p-3 text-dark fw-bold fs-1 uppercase text-white"> Успешна апликација!</p>
            <p class="p-3 text-dark fw-bold fs-1 uppercase text-white"> Ви благодариме!</p>
            <a href="employment.php" class="text-dark fw-bold fs-2 p-3 text-white"> Вратeтe се назад</a>
            <a href="index.php" class="text-dark fw-bold fs-2 p-3 text-white"> Вратeтe се на страната Brainster Labs</a>
            <img src="assets/Logo.png" class="text-end">
          </div>

        </div>

        
      </body>
    </html>
   
   ' 
  
?>
 