<?php

class Teacherppp_controller extends Controller{

    function __construct()
    {
        
    }

    static function index(){
        if (!Auth::validate()) {
            Flasher::new('Debes iniciar sesión primero.', 'danger');
            Redirect::to(ROUTE_PREFIX.'login');
        }
        View::render('index',['module' => 'teacher ppp']);
    }

    static function show_ppp(){
        //using ajax
        if($_POST){
            if($_POST['select_especialidad_pp'] && $_POST['select_module_pp'] && $_POST['select_year_visi'] && $_POST['select_period_visi']){
                $select_especialidad_pp = scape_string(clean($_POST['select_especialidad_pp']));
                $select_module_pp = scape_string(clean($_POST['select_module_pp']));
                $select_year_visi = scape_string(clean($_POST['select_year_visi']));
                $select_period_visi = scape_string(clean($_POST['select_period_visi']));
                require_once(MODELS.'practicas_model.php');
                $practicas = new Practicas_model();
                $p = $practicas->get_practicas_by_Es_Mod_Anio_Periodo($select_especialidad_pp, $select_module_pp, $select_year_visi,$select_period_visi,$_SESSION['USER-LOGIN']->usuario);

                echo json_encode(array('success' => $p->fetchAll()));  //$p->fetchObject()
            }else{
                echo json_encode(array('success' => null));
            }
        }else{
            echo json_encode(array('success' => null));
        }
    }

    static function load_modules(){
        //select_especialidad_pp
        //select_module_pp
        if($_POST){
            $select_especialidad_pp = scape_string(clean($_POST['select_especialidad_pp']));
            if($select_especialidad_pp){
                require_once(MODELS.'modulo_model.php');
                $m = new Modulo_model();
                $mod = $m->get_modulos_by_Id_especialidad($select_especialidad_pp);
                echo json_encode(array('success' => $mod->fetchAll()));
            }else{
                echo json_encode(array('success' => null));
            }
        }else{
            echo json_encode(array('success' => null));
        }
    }

    static function validate_practica(){
        if($_POST){
            $id_practicas = scape_string(clean($_POST['id_practicas']));
            $date_validate = scape_string(clean($_POST['fecha_validate_practica']));
            
            if($id_practicas && $date_validate ){
                
                require_once(MODELS.'practicas_model.php');
                $practicas = new Practicas_model();
                $date_v = '0000-00-00 00:00:00';
                $r = 0;
               
                if($date_validate =='0000-00-00 00:00:00'){
                    $date_v = date('Y-m-d H:i:s');
                    $res = $practicas->update_validacion_practica($id_practicas,$date_v);
                    if($res){
                        $r = 1;
                    }
                }else{
                    $res = $practicas->update_validacion_practica($id_practicas,$date_v);
                    if($res){
                        $r = 2;
                    }
                }
                echo json_encode(array('success' => 2, 'date_validation' => $date_v, 'id_practicas_json' => $id_practicas ));
            }else{
                echo json_encode(array('success' => null));
            }
        }else{
            echo json_encode(array('success' => null));
        }
    }
}