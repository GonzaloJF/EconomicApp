<?php
  require_once '../connection.php';

  header('Content-Type: application/json');
  if($_SERVER['REQUEST_METHOD']==='POST'){
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    if(!$data || empty($data['name_user'])|| empty($data['last_name']) || empty($data['email']) || empty($data['password']) || empty($data['confirmPassword'])){
      http_response_code(400);
      echo json_encode(['success'=>false, 'message' => 'Datos del formulario incompletos']);
      exit;
    }
    
    if($data['password'] !== $data['confirmPassword']){
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden']);
      exit;
    }
    
    try{
      $objetoConnection = new CConexion();
      $pdo = $objetoConnection->ConexionBD();
      
      $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

      $sql = "INSERT INTO users(name_user, last_name, email, password_user) VALUES (:name_user, :last_name, :email, :password_user)";
      $stmt = $pdo->prepare($sql);

      $stmt ->execute([
        ':name_user' => $data['name_user'],
        ':last_name' => $data['last_name'],
        ':email' => $data['email'],
        ':password_user' => $passwordHash
      ]);

      http_response_code(201);
      echo json_encode(['success'=> true, 'message'=> 'Usuario registrado correctamente']);
    } catch(Throwable $exp) {
      http_response_code(500); // Es un error de servidor, mejor usar 500
      echo json_encode(['success'=> false, 'message'=> $exp->getMessage()]);
    }
  }
?>