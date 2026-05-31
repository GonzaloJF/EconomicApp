<?php 
  require_once '../connection.php';

  header('Content-Type: application/json');

  if(isset($_GET['email']) && !empty($_GET['email'])){
    try {
      $objetoConexion = new CConexion();
      $pdo = $objetoConexion->ConexionBD();

      $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
      $stmt->execute(['email' => $_GET['email']]);
      $existe = $stmt->fetchColumn() > 0;
      echo json_encode(['existe' => $existe]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => $e->getMessage()]);
    }
  }else{
    echo json_encode(['existe' => false]);
  }
?>