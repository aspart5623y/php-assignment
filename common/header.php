<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Assignment</title>
    <link href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
   
  <?php 
    // include_once "../config/db_connect.php";
    // include_once "../common/validation.php";
    session_start();
    // include_once "../config/db_connect.php";
    if (!($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php')) {
      ?>
        <div class="container my-4">
          <a href="/" class="text-dark text-decoration-none font-bold">
            <i class="fa fa-home"></i>
            &nbsp;
            Home 
          </a> 
        </div>
      <?php
    }
  ?>
