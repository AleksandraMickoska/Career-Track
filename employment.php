<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Вработување</title>
     
    </head>

  <body>
      <!--Navbar code start-->
      <nav id="navbar" class="navbar navbar-expand-lg bg-warning">
            <a class="navbar-brand text-dark fw-bold d-block text-center pb-0 " href="index.php">
                <img src="assets/Logo.png" alt="logo" id="logo" class="pl-3"> 
                <p class="logo-text pb-0 m-0"> Brainster</p>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i id="navbar-toggle-icon" class="bi bi-list"></i>                
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-dark fw-bold" href="https://marketpreneurs.brainster.co" target="_blank">Академија за маркетинг</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="https://codepreneurs.brainster.co" target="_blank">Академија за програмирање</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark fw-bold" href="https://codepreneurs.brainster.co" target="_blank">Академија за data science</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="https://design.brainster.co" target="_blank">Академија за дизајн</a>
                     </li>
                </ul>
                <button class="btn btn-danger border-radius-5 fw-bold employment"><a  href="employment.php" target="_blank" class="fw-bold text-white">Вработи наш студент</a></button> 

            </div>
        </nav>


       
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

            <script>
                document.querySelector(".navbar-toggler").addEventListener("click", toggleLogo);

                function toggleLogo() {
                    var logoVisibility = document.querySelector(".navbar-brand").style.visibility;
                    if(logoVisibility == 'visible' || logoVisibility == '') {
                        document.querySelector(".navbar-brand").style.visibility = "hidden"; 
                    } else {
                        document.querySelector(".navbar-brand").style.visibility = "visible";
                    }

                    document.querySelector("#navbar-toggle-icon").classList.toggle('bi-list');
                    document.querySelector("#navbar-toggle-icon").classList.toggle('bi-x');
                    
                    document.querySelector("#navbar").classList.toggle('nav-shown');
                }

            </script>
        <!--Navbar code end-->      


    <div class="container-fluid bg-warning">
      <div class="row p-5">
          <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 d-flex justify-content-center flex-column align-items-center text-center">
              <p class="text-dark shadow rounded-3 fw-bold p-5 work" id="employment">Вработи студенти</p>
          </div>
      </div>      
       <!--Form-->
       <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <form  action="insert_student.php" method="POST" class="shadow p-3 mb-5 rounded-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">Име и презиме</label>
                                        <input  name = "fullName" type="text" class="form-control fst-italic" id="name" aria-describedby="name" placeholder="Вашето име и презиме" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Вашиот имејл</label>
                                        <input name = "email" type="email" class="form-control fst-italic" id="email" aria-describedby="email" placeholder="Контакт имејл на вашата компанија" required>
                                    </div>
                                    <div class="dropdown pt-3">
                                        <select name="studentType" class = "text-dark bg-white fw-bold" style="width: 100%;">
                                          <option class = "text-dark bg-white fw-bold" value="" >Изберете тип на студент</option>
                                          <?php
                                            require_once("students_type.php");
                                            getStudentTypes();
                                          ?>
                                        </select>
                                    </div>                                  
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 pb-5">
                                    <div class="mb-3">
                                        <label for="companyname" class="form-label fw-bold ">Име на компанија</label>
                                        <input name = "companyName" type="text" class="form-control fst-italic" id="companyname" aria-describedby="companyname" placeholder="Име на вашата компанија"style="width: 100%;" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="number" class="form-label fw-bold">Контакт телефон</label>
                                        <input  name = "telephone"  type="number" class="form-control fst-italic" id="number" aria-describedby="number" placeholder="Контакт телефон на вашата компанија" required>
                                    </div>                            
                                    <button type="submit" class="btn btn-danger mt-3 p-1 fw-bold" style="width: 100%;">Испрати</button>                               
                                </div>
                            </div>
                        </form>
                    </div>                   
                </div>                
            </div>            
        </div>               
    </div>
    <footer class="bg-dark text-center pt-3 pb-3">
        <p class="text-white fw-bold pt-3">Изработено со <i class="fa fa-heart" style="color: red;" ></i> од студентите на Brainster</p>
    </footer>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
 
  </body>
</html>