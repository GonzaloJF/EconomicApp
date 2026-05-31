<?php 
  //inicializar sesion siempre al principio
  session_start();  
  require_once '../connection.php';

  header('Content-Type: application/json');

  if($_SERVER['REQUEST_METHOD']==='POST'){
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    if(!$data || empty($data['email']) || empty($data['password'])){
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Datos del formulario incompleto']);
      exit;
    }

    try{
      //establecer conexion
      $objetoConnection = new CConexion();
      $pdo = $objetoConnection->ConexionBD();

      //Buscar al usuario en la base de datos por su email: 
      $stmt = $pdo->prepare("SELECT user_id, password_user, email FROM users WHERE email = :email");
      $stmt->execute(['email'=> $data['email']]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!$user || !password_verify($data['password'],$user['password_user'])){
        http_response_code(401);
        echo json_encode(['success'=>false, 'message'=>'Credenciales incorrectas']);
        exit;
      }
      
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['logged_in'] = true;

      echo json_encode(['success'=> true, 'message'=> 'Usuario logeado correctamente']);
  
    }catch (Throwable $exp){
      http_response_code(500);
      echo json_encode(['success'=> false, 'message'=> $exp->getMessage()]);
    }
  }
?>