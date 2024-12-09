<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">
    <title>IT Collage rooms</title>
<style>
.h-font , .text{
  font-family :'Merienda' , cursive;

}
a{
  text-decoration : none;
  color :black;
}
a:hover{
  color:white;
}
h5{
  margin-bottom:150px;
}
.container {
  background-image:url(IT.jpg);
  position:relative;
  width :100%;
  height:540px;
  background-size:cover;
  backgroung-size:100% 100%;
  color : black;
  text-align :center;
  line-height:320px;
}
.text {
  font-size :40px;
  padding :100px;
  font-weight :bold;
 
}
  </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font"  href="welcome.php">IT COLLAGE</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="d-flex">
      <button type="button" class="btn btn-outline-dark me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
 <a href="login.php">Login</a>
</button>
      <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#RegisterModal">
      <a href="register.php">Register</a> </button>
        <!-- admin Dashboard -->

        <button type="button" class="btn btn-outline-dark " data-bs-toggle="modal" data-bs-target="#loginModal">

<a href="Admin.php">admin Dashboard</a>

</button>

</div>
    </div>
  </div>
</nav>
<main>
<div class="container">
  <div class="text">
  Welcome To IT College Booking Room System
  </div>

</div>

  




   
   
  
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>