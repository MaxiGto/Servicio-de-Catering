<?php

class Empleados extends Model{

    public function getEncargados(){

        $this->db->query(
            "SELECT * FROM empleados
            WHERE id_cargo = 1
            ORDER BY apellido
            "
        );

        return $this->db->fetchAll();
    }

    public function getMozos(){

        $this->db->query(
            "SELECT * FROM empleados
            WHERE id_cargo = 2
            ORDER BY apellido
            "
        );

        return $this->db->fetchAll();
    }

    public function getEmpleadoByLegajo($legajo){

        $this->db->query(
            "SELECT * FROM empleados
            WHERE legajo = $legajo
            LIMIT 1
            "
        );

        return $this->db->fetch();

    }

    public function usuarioEsEmpleado($id_usuario){

        if(!ctype_digit("$id_usuario")) throw new ValidationException('ID de usuario no es un número');
        if($id_usuario < 1) throw new ValidationException('ID de usuario no puede ser menor que 1');

        $this->db->query("SELECT * FROM empleados
        WHERE id_usuario = $id_usuario
        LIMIT 1
        ");

        if($this->db->numRows() == 1) return true;
        
        return false;

    }

    public function getEmpleadoByUserID($id_usuario){

        if(!ctype_digit("$id_usuario")) throw new ValidationException('ID de usuario no es un número');
        if($id_usuario < 1) throw new ValidationException('ID de usuario no puede ser menor que 1');

        $this->db->query("SELECT * FROM empleados
        WHERE id_usuario = $id_usuario
        LIMIT 1
        ");

        return $this->db->fetch();

    }


}