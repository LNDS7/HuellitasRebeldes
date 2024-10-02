foreach($objetores as $usuario){
    if($usuario->esAdministrador()==1){
        $_SESSION["nivel"] = "admin";
    }else{
        $_SESSION["nivel"] = "user";
    }
    $_SESSION["usuario"] = $usuario;
    header("Location:index.php");
}