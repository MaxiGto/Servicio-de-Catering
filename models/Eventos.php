<?php

class Eventos extends Model{

    public function verificarIDEvento($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM eventos
            WHERE id_evento = $id_evento
            LIMIT 1
            "
        );

        if($this->db->numRows() == 1) return true;

        return false;

    }

    public function saveNuevoEvento($id_presupuesto, $direccion, $fecha, $duracion, $encargado, $descripcion){

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
            "INSERT INTO eventos(descripcion, direccion, fecha, participantes, duracion, legajo_encargado, id_solicitud)
            VALUES ('$descripcion', '$direccion', '$fecha', $participantes, $duracion, $encargado, $id_solicitud)
            "
        );

        return $this->db->insertedID();

    }

    public function getEventoByID($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM eventos
            WHERE id_evento = $id_evento
            LIMIT 1
            "
        );

        return $this->db->fetch();

    }

    public function asignarMozosEvento($id_evento, $mozos){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        foreach($mozos as $l => $m){
            if(!ctype_digit("$l")) throw new ValidationException('Legajo de mozo no es un número');
            if($l < 1) throw new ValidationException('Número de legajo de mozo no puede ser menor que 1');
        }

        foreach($mozos as $l => $m){
            $this->db->query(
                "INSERT INTO mozos_evento(id_evento, legajo)
                VALUES ($id_evento, $l)
                "
            );
        }

    }

    public function getCantidadEventosAConfirmarEncargado($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM eventos
            WHERE legajo_encargado = $legajo
            AND encargado_confirmado is NULL
            "
        );

        return $this->db->numRows();

    }

    public function getCantidadEventosConfirmadosEncargado($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM eventos
            WHERE legajo_encargado = $legajo
            AND encargado_confirmado = 'Y'
            "
        );

        return $this->db->numRows();

    }

    public function getEventosEncargado($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM eventos
            WHERE legajo_encargado = $legajo
            AND encargado_confirmado is NULL
            "
        );

        return $this->db->fetchAll();

    }

    public function getEventosConfirmadosEncargado($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM eventos
            WHERE legajo_encargado = $legajo
            AND encargado_confirmado = 'Y'
            "
        );

        return $this->db->fetchAll();

    }

    public function confirmarEventoEncargado($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "UPDATE eventos
            SET encargado_confirmado = 'Y'
            WHERE id_evento = $id_evento
            LIMIT 1
            "
        );

    }

    public function rechazarEventoEncargado($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "UPDATE eventos
            SET encargado_confirmado = 'N'
            WHERE id_evento = $id_evento
            LIMIT 1
            "
        );

    }

    public function getCantidadEventosMozo($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM mozos_evento me
            JOIN eventos e on e.id_evento = me.id_evento
            WHERE me.legajo = $legajo
            AND me.confirmado is NULL
            "
        );

        return $this->db->numRows();

    }

    public function getCantidadEventosConfirmadosMozo($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM mozos_evento me
            JOIN eventos e on e.id_evento = me.id_evento
            WHERE me.legajo = $legajo
            AND me.confirmado = 'Y'
            "
        );

        return $this->db->numRows();

    }

    public function getEventosMozo($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM mozos_evento me
            JOIN eventos e on e.id_evento = me.id_evento
            WHERE me.legajo = $legajo
            AND me.confirmado is NULL
            "
        );

        return $this->db->fetchAll();

    }

    public function getEventosConfirmadosMozo($legajo){

        if(!ctype_digit("$legajo")) throw new ValidationException('Legajo de encargado no es un número');
        if($legajo < 1) throw new ValidationException('Legajo de encargado no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM mozos_evento me
            JOIN eventos e on e.id_evento = me.id_evento
            WHERE me.legajo = $legajo
            AND me.confirmado = 'Y'
            "
        );

        return $this->db->fetchAll();

    }

    public function getMozosEvento($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "SELECT * FROM mozos_evento me
            JOIN empleados em on em.legajo = me.legajo
            WHERE me.id_evento = $id_evento
            "
        );

        return $this->db->fetchAll();

    }

    public function confirmarEventoMozo($id_evento, $legajo){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "UPDATE mozos_evento
            SET confirmado = 'Y'
            WHERE id_evento = $id_evento
            AND legajo = $legajo
            LIMIT 1
            "
        );

    }

    public function rechazarEventoMozo($id_evento, $legajo){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $this->db->query(
            "UPDATE mozos_evento
            SET confirmado = 'N'
            WHERE id_evento = $id_evento
            AND legajo = $legajo
            LIMIT 1
            "
        );

    }


    public function getCantidadMenusEvento($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $s = new Solicitudes();

        $id_solicitud = $this->getEventoByID($id_evento)['id_solicitud'];

        return $s->getTotalMenusSolicitud($id_solicitud);

    }

    public function getMenusEvento($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $s = new Solicitudes();

        $id_solicitud = $this->getEventoByID($id_evento)['id_solicitud'];

        return $s->getMenusSolicitud($id_solicitud);

    }

    public function eventoTieneServicios($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $s = new Solicitudes();

        $id_solicitud = $this->getEventoByID($id_evento)['id_solicitud'];

        return $s->solicitudTieneServicios($id_solicitud);
    }

    public function getServiciosEvento($id_evento){

        if(!ctype_digit("$id_evento")) throw new ValidationException('ID de evento no es un número');
        if($id_evento < 1) throw new ValidationException('ID de evento no puede ser menor que 1');

        $s = new Solicitudes();

        $id_solicitud = $this->getEventoByID($id_evento)['id_solicitud'];

        return $s->getServiciosSolicitud($id_solicitud);

    }



    

}