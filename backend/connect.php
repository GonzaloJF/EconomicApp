<?php
  $conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=War.Amumu132132");
  if(!$conn){
    echo "Error al establecer la conexion";
  }
  return $conn;
?>