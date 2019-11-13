<?php
  if(!isset($_SESSION["connected"]) || $_SESSION["connected"] == false){
    include('menu_not_connected.php');
  }
  else {
    include('menu_connected.php');
  }
?>