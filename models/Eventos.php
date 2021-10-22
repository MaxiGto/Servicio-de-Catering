<?php

class Eventos extends Model{

    public function saveNuevoEvento($id_presupuesto, $direccion, $fecha, $duracion, $descripcion){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        if(strlen($direccion)<6) throw new ValidationException('Dirección muy corta');
        if(strlen($direccion)>100) throw new ValidationException('Dirección muy larga');

        if(!is_numeric("$duracion")) throw new ValidationException('Duración no es un número');
        if($duracion <= 0 ) throw new ValidationException('Duración no puede ser menor o igual a 0');

        if(strlen($descripcion)>300) throw new ValidationException('Descripcion muy larga');

        $p = new Presupuestos();
        $participantes = $p->getTotalMenusPresupuesto($id_presupuesto)['total'];
        $id_solicitud = $p->getIDSolicitudPresupuesto($id_presupuesto)['id_solicitud'];

        $this->db->query(
            "INSERT INTO eventos(descripcion, direccion, fecha, participantes, duracion, id_solicitud)
            VALUES ('$descripcion', '$direccion', '$fecha', $participantes, $duracion, $id_solicitud)
            "
        );

    }

}