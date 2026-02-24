<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>ThreeWMS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $server_url?>assets/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $server_url?>assets/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $server_url?>assets/images/favicon-16x16.png">
  <link rel="manifest" href="<?php echo $server_url?>assets/site.webmanifest">

  <!-- jquery  -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- bootstrap  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

  <!-- bootbox  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

  <!-- overlay loader -->
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

  <!-- bootstrap css  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- flatpickr date -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <!-- autocomplete  -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"></script>

  <!-- alasql  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/4.6.6/alasql.min.js" integrity="sha512-a0dn7nW2exqcTrj7ZcLhRW3iDxCKOh9GPa1jf27qljXfwhYp4tnNmm+8aRNp9c3ijpGsm7EmeGSQmcu80ZB3NA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- dropzone  -->
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <script>
    // This kills the CDN's auto-scanner so it doesn't conflict with main.js
    Dropzone.autoDiscover = false; 
  </script>
  
  <!-- theme script  -->
  <link rel="stylesheet" href="<?php echo $server_url?>assets/css/main.css">
  <link rel="stylesheet" href="<?php echo $server_url?>assets/css/custom.css">
  <script type="module" src="<?php echo $server_url?>assets/js/main.js"></script>
  <script src="<?php echo $server_url?>assets/js/custom.js"></script>

</head>