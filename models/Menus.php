<?php

class Menus extends Model{

    public function getTodos(){
        $this->db->query("SELECT * FROM menus");
        return $this->db->fetchAll();
    }

    public function getMenusEvento($menus){

        $res = array();

        foreach($menus as $id => $cantidad){

            if(!ctype_digit("$id")) throw new ValidationException('ID menú no es un número');
            if($id < 1) throw new ValidationException('ID menú menor que 1');

            if(!ctype_digit("$cantidad")) throw new ValidationException('Cantidad no es un número');
            if($cantidad < 1) throw new ValidationException('La cantidad debe ser mayor que 0');

            $this->db->query("SELECT * FROM menus
                            WHERE id_menu = $id
            ");

            $res["$id"] = $this->db->fetch();
            $res["$id"]["cantidad"] = $cantidad;
        }

        return $res;

    }

}

class ValidationException extends Exception {}