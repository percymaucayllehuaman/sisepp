<?php

class Asistenciaactividad_model extends Model{

    function add_asis($data){
        $query = "insert into asistencia_actividad(Practicas_id_practicas, 
        Practicas_Estudiantes_DNI, fecha, fecha_hora_entrada, validacion_entrada, actividad, 
        validacion_actividad, fecha_hora_salida, validacion_salida, observacion) 
        values (:Practicas_id_practicas, :Practicas_Estudiantes_DNI, :fecha, 
        :fecha_hora_entrada, :validacion_entrada, :actividad, :validacion_actividad, 
        :fecha_hora_salida, :validacion_salida, :observacion)";

        $statement = parent::connect()->prepare($query);
        $statement->bindParam(':Practicas_id_practicas',$data['Practicas_id_practicas']);
        $statement->bindParam(':Practicas_Estudiantes_DNI',$data['Practicas_Estudiantes_DNI']);
        $statement->bindParam(':fecha',$data['fecha']);
        $statement->bindParam(':fecha_hora_entrada',$data['fecha_hora_entrada']);
        $statement->bindParam(':validacion_entrada',$data['validacion_entrada']);
        $statement->bindParam(':actividad',$data['actividad']);
        $statement->bindParam(':validacion_actividad',$data['validacion_actividad']);
        $statement->bindParam(':fecha_hora_salida',$data['fecha_hora_salida']);
        $statement->bindParam(':validacion_salida',$data['validacion_salida']);
        $statement->bindParam(':observacion',$data['observacion']);
        $statement->execute();
        return $statement;
    }

    function register_salida($id, $date_salida){
        $query = "update asistencia_actividad set fecha_hora_salida = :salida where id_asistencia_actividad = :id_asistencia";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':salida',$date_salida);
            $statement->bindParam(':id_asistencia',$id);
            $statement->execute();    
            return $statement;
        } catch (Exception $e) {
            throw $e;
        }
        return;
    }
    function register_actividad($id, $actividad){
        $query = "update asistencia_actividad set actividad = :actividad where id_asistencia_actividad = :id_asistencia";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':actividad',$actividad);
            $statement->bindParam(':id_asistencia',$id);
            $statement->execute();    
            return $statement;
        } catch (Exception $e) {
            throw $e;
        }
        return;
    }
    function get_by_IdandDNIandDate($id, $dni, $date){
        $query = "select * from asistencia_actividad where id_asistencia_actividad = :id and 
        Practicas_Estudiantes_DNI = :dni and fecha = :date ";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':id',$id);
            $statement->bindParam(':dni',$dni);
            $statement->bindParam(':date',$date);
            $statement->execute();    
            return ($statement->rowCount() > 0)? $statement->fetchObject() : false;
        } catch (Exception $e) {
            throw $e;
        }
        return;
    }
    function list_students_asistencia_Teacher($especialidad, $modulo, $date){
        $query = "SELECT * FROM asistencia_actividad aa inner join Practicas p  on aa.Practicas_id_practicas = p.id_practicas inner join estudiantes e on p.Estudiantes_DNI = e.DNI 
        inner join especialidad es on es.id_especialidad = p.especialidad_id_especialidad inner join modulo m on m.especialidad_id_especialidad = es.id_especialidad 
        where es.id_especialidad = :especialidad and m.id_modulo = :modulo and aa.fecha = :fecha order by aa.id_asistencia_actividad desc";            
        try{
            $statement = $this->connect()->prepare($query);
            $statement->bindParam(':especialidad',$especialidad);
            $statement->bindParam(':modulo',$modulo);
            $statement->bindParam(':fecha',$date);
            $statement->execute();
            return $statement;
            // return ($statement->rowCount()>0) ? true : false ;
        }catch(Exception $e){
            throw $e;
        } 
    }
    function get_by_DNIandDate($dni, $date){
        $query = "select * from asistencia_actividad where  
        Practicas_Estudiantes_DNI = :dni and fecha = :date ";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':dni', $dni);
            $statement->bindParam(':date', $date);
            $statement->execute();    
            return ($statement->rowCount() > 0)? $statement->fetchObject() : false;
        } catch (Exception $e) {
            throw $e;
        }
        return;
    }
    function get_all_by_dni($dni){
        $query = "select * from asistencia_actividad where Practicas_Estudiantes_DNI = :dni order by Practicas_id_practicas desc limit 10";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':dni',$dni);
            $statement->execute();
            return $statement;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function get_by_id($id){
        $query = "select * from asistencia_actividad where id_asistencia_actividad = :id";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':id',$id);
            $statement->execute();
            return ($statement->rowCount() > 0)? $statement->fetchObject() : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function falta_registrar_salida($id, $dni){
        $query = "select * from asistencia_actividad where id_asistencia_actividad = :id and fecha_hora_salida like :salida and Practicas_Estudiantes_DNI = :dni";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':id',$id);
            $statement->bindParam(':salida','0000-00-00 00:00:00');
            $statement->bindParam(':dni',$dni);
            $statement->execute();
            return ($statement->rowCount() > 0)? $statement->fetchObject() : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    function falta_registrar_entrada($id, $dni){
        $query = "select * from asistencia_actividad where id_asistencia_actividad = :id and fecha_hora_salida like :salida and Practicas_Estudiantes_DNI = :dni";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':id',$id);
            $statement->bindParam(':salida','0000-00-00 00:00:00');
            $statement->bindParam(':dni',$dni);
            $statement->execute();
            return ($statement->rowCount() > 0)? $statement->fetchObject() : false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    function update_date_asistenciaActividad($id,$actividad_date){
        $query = "update asistencia_actividad set validacion_actividad = :actividad_date where id_asistencia_actividad = :id";
        try {
            $statement = parent::connect()->prepare($query);
            $statement->bindParam(':actividad_date',$actividad_date);
            $statement->bindParam(':id',$id);
            $statement->execute();
            return ($statement) ? $statement : false;
        } catch (Exception $e) {
            throw $e;
        }
    }



}

?>