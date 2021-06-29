<?php

class Presupuestos extends Model{

    public function savePresupuesto($monto, $adicional, $id_solicitud){

        if(!is_numeric($monto)) throw new ValidationException('Monto no es un número');
        if($monto <= 0) throw new ValidationException('El monto debe ser mayor a 0');

        if(!is_numeric($adicional)) throw new ValidationException('Monto adicional no es un número');
        if($adicional < 0) throw new ValidationException('El monto adicional debe ser mayor o igual a 0');

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("INSERT INTO presupuestos(fecha, monto, monto_adicional, id_solicitud)
                        VALUES (NOW(), $monto, $adicional, $id_solicitud)

        ");
    }

}