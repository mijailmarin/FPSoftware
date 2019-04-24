<?php
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Log\LoggerInterface;
use Slim\Container;
use \controllers\UsuarioController as UsuarioController;

$app->get('/', function ($request, $response, $args) {   
    if (isset($_SESSION["usuario"])){
        return $response->withRedirect('/sorteo');
    }   
    return $this->renderer->render($response, "/login.php", $args);
});
$app->post('/', function ($request, $response, $args) { 
    $resultado = array();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["txtEmail"]) && isset($_POST["txtPassword"])) {
            $txtEmail = validar_campo($_POST["txtEmail"]);
            $txtPassword = validar_campo($_POST["txtPassword"]);
            $resultado = array("estado" => "true");
            if(UsuarioController::login($txtEmail, $txtPassword)) {
                $usuario = UsuarioController::getUsuario($txtEmail, $txtPassword);
                $_SESSION["usuario"] = array(
                    "id" => $usuario->getId(),
                    "nombre" => $usuario->getNombre(),
                    "apellido" => $usuario->getApellido(),
                    "correo" => $usuario->getEmail(),                    
                    "privilegio" => $usuario->getPrivilegio(),
                    "fecha_registro" => $usuario->getFecha_registro(),
                    "token" => $usuario->getToken(),
                );
                return $response->withRedirect('/sorteo');
            }
        }
    }  
    echo "<script>alert('Datos de login no validos, vuelve a intentar.');</script>";  
    echo "<script type='text/javascript'> document.location = '/'; </script>"; 
});

$app->get('/admin', function ($request, $response, $args) {
    if (isset($_SESSION["usuario"])) {
        if ($_SESSION["usuario"]["privilegio"] == 2) {
            return $response->withRedirect('/sorteo');
        }
    } else {
        return $response->withRedirect('/');
    }
    return $this->renderer->render($response, "/admin.php", $args);
});

$app->get('/logout', function(Request $request, Response $response){  
    $_SESSION = array();
    if (ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 60*60,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    unset($_SESSION['usuario']);
    session_destroy();
    return $response->withRedirect('/');
});

$app->get('/registro', function ($request, $response, $args) {
    return $this->renderer->render($response, "/registro.php", $args);
});
$app->post('/registro', function ($request, $response, $args) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["txtNombre"]) && isset($_POST["txtApellido"]) && isset($_POST["txtEmail"]) && isset($_POST["txtPassword"])) {    
            $txtNombre = validar_campo($_POST["txtNombre"]);
            $txtApellido = validar_campo($_POST["txtApellido"]);
            $txtEmail = validar_campo($_POST["txtEmail"]);
            $txtPassword = validar_campo($_POST["txtPassword"]);
            if (UsuarioController::registrar($txtNombre, $txtApellido, $txtEmail, $txtPassword)) {
                $usuario = UsuarioController::getUsuario($txtEmail, $txtPassword);
                $_SESSION["usuario"] = array(
                    "id" => $usuario->getId(),
                    "nombre" => $usuario->getNombre(),
                    "apellido" => $usuario->getApellido(),
                    "correo" => $usuario->getEmail(),
                    "privilegio" => $usuario->getPrivilegio(),
                    "fecha_registro" => $usuario->getFecha_registro(),
                    "token" => $usuario->getToken()
                );    
                return $response->withRedirect('/sorteo');
            }    
        }
    } else {
        echo "<script>alert('Datos de registro no validos, vuelve a intentar.');</script>";  
        echo "<script type='text/javascript'> document.location = '/registro'; </script>"; 
    }
});

$app->get('/sorteo', function ($request, $response, $args) {
    if (isset($_SESSION["usuario"])){
        if ($_SESSION["usuario"]["privilegio"] == 1) {
            return $response->withRedirect('/admin');
        }
    } 
    else {
        return $response->withRedirect('/');
    }    
    $usuario_id = $_SESSION["usuario"]["id"];
    $sorteo = UsuarioController::getSorteos($usuario_id); 
    $args = ['sorteo' => $sorteo];   
    return $this->renderer->render($response, "/sorteo.php", $args);
});

$app->get('/sorteo_c{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');
    if (isset($_SESSION["usuario"])){
        if($_SESSION["usuario"]["privilegio"] == 1) {
            return $response->withRedirect('/admin');
        }
        if($_SESSION["usuario"]["id"] != $id){
            return $response->withRedirect('/sorteo');
        }
    } 
    else {
        return $response->withRedirect('/');
    }    
    return $this->renderer->render($response, "/crear_sorteo.php", $args);
});
$app->post('/sorteo_c{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["txtTitulo"]) && isset($_POST["txtParticipantes"])) {
            $txtTitulo = validar_campo($_POST["txtTitulo"]);
            $txtParticipantes = validar_campo($_POST["txtParticipantes"]); 
            if(intval($txtParticipantes) >= 2){                           
                if (UsuarioController::setSorteo($txtTitulo, $txtParticipantes, $id)) {                
                    return $response->withRedirect('/sorteo');
                } 
            }  
            else {
                echo "<script>alert('Deben existir minimo 2 participantes, vuelve a intentar.');</script>";  
                echo "<script type='text/javascript'> document.location = '/sorteo'; </script>"; 
            }  
               
        }        
    } else {
        echo "<script>alert('Datos del sorteo no validos, vuelve a intentar.');</script>";  
        echo "<script type='text/javascript'> document.location = '/sorteo'; </script>"; 
    }
});

$app->get('/sorteo_d{id}', function ($request, $response, $args) { 
    $sorteo_id = $request->getAttribute('id');
    $usuario_id = $_SESSION["usuario"]["id"];
    $sorteos = UsuarioController::getSorteos($usuario_id); 
    foreach($sorteos as $misSorteos){
        echo $misSorteos[0];
    }
    
    if (isset($_SESSION["usuario"])){
        if($_SESSION["usuario"]["privilegio"] == 1) {
            return $response->withRedirect('/admin');
        }
        
        if($misSorteos[0] != $sorteo_id){
            if(UsuarioController::getSorteos($usuario_id)){
                if(UsuarioController::deleteSorteo($sorteo_id)){                
                    return $response->withRedirect('/sorteo');
                } 
                else{
                    echo "<script>alert('No se puede eliminar, vuelve a intentar.');</script>";  
                    echo "<script type='text/javascript'> document.location = '/sorteo'; </script>"; 
                }
            }
            else{
                echo "<script>alert('No se pudo encontrar el sorteo, vuelve a intentar.');</script>";  
                echo "<script type='text/javascript'> document.location = '/sorteo'; </script>"; 
            }
        }
        else{
            echo "<script>alert('Error! Ese ID de sorteo no existe.');</script>";  
            echo "<script type='text/javascript'> document.location = '/sorteo'; </script>"; 
        }     
    } 
    else {
        return $response->withRedirect('/sorteo');
    }        
});