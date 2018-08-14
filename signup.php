<?php

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Cart e-Mart</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/signup.css">

  
</head>

<body>

  
<div class="app">
  <div class="content">
    <div class="button">
      <div class="sign-up">SIGN UP</div>
      <form class="hidden form">
        <input type="text" placeholder="Username"/>
        <input type="email" placeholder="Email Id"/>
        <input type="password" placeholder="Password"/>
      </form>
      <button class="hidden"><span class="text">DONE</span></button>
    </div>
  </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script>
  $(".sign-up").on('click', function() {
  $(".button").addClass("expanded");
  $(".sign-up").addClass("hidden");
  $(".content").addClass("background");
  $("button").removeClass("hidden");
  $("form").toggleClass("hidden");
})

 $("button").on('click', function() {
  $(this).remove();
  $("form").remove();
  $(".button").remove();
  $(".text").remove();
  $(".header").removeClass("hidden");
})</script>

</body>

</html>
