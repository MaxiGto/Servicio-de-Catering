<?php

class Turnos extends Model{

    public function getTurnoByID($id_turno){

        if(!ctype_digit("$id_turno")) throw new ValidationException('ID de usuario no es un número');
        if($id_turno < 1) throw new ValidationException('ID de usuario no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM turnos
            WHERE id_turno = $id_turno
            LIMIT 1
            "
        );

        return $this->db->fetch();

    }
}