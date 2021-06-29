<?php

class Servicios extends Model{

    public function getTodos(){
        $this->db->query("SELECT * FROM servicios_adicionales");
        return $this->db->fetchAll();
    }

    public function getServiciosEvento($servicios){

        $res = array();

        foreach($servicios as $id){

            if(!ctype_digit("$id")) throw new ValidationException('ID servicio no es un número');
            if($id < 1) throw new ValidationException('ID servicio menor que 1');

            $this->db->query("SELECT * FROM servicios_adicionales
                            WHERE id_servicio = $id
            ");

            $res[] = $this->db->fetch();
        }

        return $res;

    }

}