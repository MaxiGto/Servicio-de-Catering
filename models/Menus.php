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

    public function verificarMenu($id_menu){

        if(!ctype_digit("$id_menu")) throw new ValidationException('ID menú no es un número');
        if($id_menu < 1) throw new ValidationException('ID menú menor que 1');

        $this->db->query("SELECT * FROM menus
                            WHERE id_menu = $id_menu
                            LIMIT 1
        ");

        if($this->db->numRows($this->db->fetch()) == 1) return true;

        return false;
    }

    public function getMenuByID($id_menu){

        if(!ctype_digit("$id_menu")) throw new ValidationException('ID menú no es un número');
        if($id_menu < 1) throw new ValidationException('ID menú menor que 1');

        $this->db->query("SELECT * FROM menus
                        WHERE id_menu = $id_menu
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function setPrecioMenu($id_menu, $precio){

        if(!ctype_digit("$id_menu")) throw new ValidationException('ID menú no es un número');
        if($id_menu < 1) throw new ValidationException('ID menú menor que 1');

        if(!is_numeric("$precio")) throw new ValidationException('El precio no es un número');
        if($precio < 0) throw new ValidationException('El precio no puede ser negativo');

        $this->db->query("UPDATE menus
                        SET precio = $precio
                        WHERE id_menu = $id_menu
                        LIMIT 1
        ");

    }

}

class ValidationException extends Exception {}