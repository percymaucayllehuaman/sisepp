<?php 
class Adminconvenios_controller extends Controller{
    
    function __construct()
    {
        
    }

    static function index(){
        if (!Auth::validate()) {
            Flasher::new('Debes iniciar sesión primero.', 'danger');
            Redirect::to(ROUTE_PREFIX.'login');
        }
        View::render('index',['module' => 'admincontroller']);
    }

    static function registro(){
        if (!Auth::validate()) {
            Flasher::new('Debes iniciar sesión primero.', 'danger');
            Redirect::to(ROUTE_PREFIX.'login');
        }
        View::render('index',['module' => 'admincontroller']);

    }

    static function register(){
        echo "registrar convenio";
        return;
    }

   

}


?>