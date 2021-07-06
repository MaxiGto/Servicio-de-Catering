<?php

class Solicitudes extends Model{

    public function saveSolicitud($comentario, $id_cliente, $menus, $servicios){

        if(strlen($comentario) > 300) throw new ValidationException('Comentario muy largo');
        $comentario = $this->db->escape($comentario);

        $c = new Clientes();

        if(!ctype_digit("$id_cliente")) throw new ValidationException('ID cliente no es un número');
        if($id_cliente < 1) throw new ValidationException('ID cliente no puede ser menor que 1');
        if(!$c->verificarIDCliente($id_cliente)) throw new ValidationException('ID de cliente inválido');

        foreach($menus as $id => $cantidad){

            if(!ctype_digit("$id")) throw new ValidationException('ID de menú no es un número');
            if($id < 1) throw new ValidationException('ID de menú no puede ser menor que 1');

            if(!ctype_digit("$cantidad")) throw new ValidationException('Cantidad no es un número');
            if($cantidad < 1) throw new ValidationException('Cantidad no puede ser menor que 1');
        }

        $this->db->query("INSERT INTO solicitudes(fecha, comentario, id_cliente)
                        VALUES (NOW(), '$comentario', $id_cliente)
        ");

        $lastID = $this->db->insertedID();

        $this->saveMenusSolicitud($lastID, $menus);

        if(count($servicios) > 0){
            $total = $this->getTotalMenusSolicitud($lastID);
            $this->saveServiciosSolicitud($lastID, $servicios, $total['total']);
        } 

    }

    public function saveMenuSolicitud($id_solicitud, $id_menu, $cantidad){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        if(!ctype_digit("$id_menu")) throw new ValidationException('ID de menú no es un número');
        if($id_menu < 1) throw new ValidationException('ID de menú no puede ser menor que 1');

        if(!ctype_digit("$cantidad")) throw new ValidationException('Cantidad no es un número');
        if($cantidad < 1) throw new ValidationException('Cantidad no puede ser menor que 1');

        $m = new Menus();
        if(!$m->verificarMenu($id_menu)) throw new ValidationException('ID de menú inválido');

        $this->db->query("INSERT INTO menus_evento (id_solicitud, id_menu, cantidad)
                            VALUES ($id_solicitud, $id_menu, $cantidad)
        ");

    }

    public function saveMenusSolicitud($id_solicitud, $menus){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $m = new Menus();

        foreach($menus as $id => $cantidad){

            if(!ctype_digit("$id")) throw new ValidationException('ID de menú no es un número');
            if($id < 1) throw new ValidationException('ID de menú no puede ser menor que 1');

            if(!ctype_digit("$cantidad")) throw new ValidationException('Cantidad no es un número');
            if($cantidad < 1) throw new ValidationException('Cantidad no puede ser menor que 1');

            if(!$m->verificarMenu($id)) throw new ValidationException('ID de menú inválido');
        }

        foreach($menus as $id => $cantidad){
            $this->db->query("INSERT INTO menus_evento (id_solicitud, id_menu, cantidad)
                            VALUES ($id_solicitud, $id, $cantidad)
        ");

        }

    }

    public function getSolicitudesPendientes(){

        $this->db->query("SELECT * FROM solicitudes
                        WHERE id_solicitud NOT IN
                        (SELECT id_solicitud FROM presupuestos)
        ");

        return $this->db->fetchAll();

    }

    public function getCantidadSolicitudesPendientes(){

        $this->db->query("SELECT * FROM solicitudes
                        WHERE id_solicitud NOT IN
                        (SELECT id_solicitud FROM presupuestos)
        ");

        return $this->db->numRows();

    }

    public function getSolicitudByID($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');        

        $this->db->query("SELECT * FROM solicitudes
                        WHERE id_solicitud = $id_solicitud
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function verificarIDSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');        

        $this->db->query("SELECT * FROM solicitudes
        WHERE id_solicitud = $id_solicitud
        LIMIT 1
        ");

        if($this->db->numRows() == 1) return true;

        return false;
    }

    public function getMenusSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT m.id_menu, m.nombre , m.precio, me.cantidad, (m.precio * me.cantidad) as total FROM solicitudes sol
                        LEFT JOIN menus_evento me on me.id_solicitud = sol.id_solicitud
                        LEFT JOIN menus m on m.id_menu = me.id_menu
                        WHERE sol.id_solicitud = $id_solicitud
        ");

        return $this->db->fetchAll();

    }

    public function getPrecioTotalMenusSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT sol.id_solicitud, SUM(m.precio * me.cantidad) as 'total_menus' FROM solicitudes sol
                        LEFT JOIN menus_evento me on me.id_solicitud = sol.id_solicitud
                        LEFT JOIN menus m on m.id_menu = me.id_menu
                        WHERE sol.id_solicitud = $id_solicitud
                        GROUP BY sol.id_solicitud
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function getTotalMenusSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT id_solicitud, SUM(cantidad) as 'total' 
                                FROM menus_evento
                                WHERE id_solicitud = $id_solicitud
                                GROUP BY id_solicitud
                                LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function getMenusNotInSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT DISTINCT m.id_menu, m.nombre from menus m
                        INNER JOIN menus_evento me on me.id_menu = m.id_menu
                        WHERE me.id_menu NOT IN
                        (SELECT id_menu from menus_evento
                        WHERE id_solicitud = $id_solicitud)
        ");

        return $this->db->fetchAll();

    }

    public function getCantidadTiposMenusSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT * from menus_evento
                        WHERE id_solicitud = $id_solicitud
        ");

        return $this->db->numRows($this->db->fetchAll());
    }

    public function eliminarMenuSolicitud($id_solicitud, $id_menu){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        if(!ctype_digit("$id_menu")) throw new ValidationException('ID de menú no es un número');
        if($id_menu < 1) throw new ValidationException('ID de menú no puede ser menor que 1');

        $this->db->query("DELETE from menus_evento
                        WHERE id_solicitud = $id_solicitud
                        AND id_menu = $id_menu
                        LIMIT 1
        ");

    }

    public function saveServicioSolicitud($id_solicitud, $id_servicio){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        if(!ctype_digit("$id_servicio")) throw new ValidationException('ID de menú no es un número');
        if($id_servicio < 1) throw new ValidationException('ID de menú no puede ser menor que 1');

        $res = $this->getTotalMenusSolicitud($id_solicitud);

        $cantidad = $res['total'];

        $this->db->query("INSERT INTO servicios_evento (id_solicitud, id_servicio, cantidad)
                            VALUES ($id_solicitud, $id_servicio, $cantidad)
        ");

    }

    public function saveServiciosSolicitud($id_solicitud, $servicios, $total){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        foreach($servicios as $id){

            if(!ctype_digit("$id")) throw new ValidationException('ID de servicio no es un número');
            if($id < 1) throw new ValidationException('ID de servicio no puede ser menor que 1');
        }

        if(!ctype_digit("$total")) throw new ValidationException('Total no es un número');
        if($total < 1) throw new ValidationException('Total no puede ser menor que 1');

        foreach($servicios as $id){
            $this->db->query("INSERT INTO servicios_evento (id_solicitud, id_servicio, cantidad)
                            VALUES ($id_solicitud, $id, $total)
        ");

        }
    }

    public function getServiciosSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT s.id_servicio, s.nombre , s.precio, se.cantidad, (s.precio * se.cantidad) as total FROM solicitudes sol
                        LEFT JOIN servicios_evento se on se.id_solicitud = sol.id_solicitud
                        LEFT JOIN servicios_adicionales s on s.id_servicio = se.id_servicio
                        WHERE sol.id_solicitud = $id_solicitud
        ");

        return $this->db->fetchAll();

    }

    public function getServiciosNotInSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT DISTINCT s.id_servicio, s.nombre from servicios_adicionales s
                        INNER JOIN servicios_evento se on se.id_servicio = s.id_servicio
                        WHERE se.id_servicio NOT IN
                        (SELECT id_servicio from servicios_evento
                        WHERE id_solicitud = $id_solicitud)
        ");

        return $this->db->fetchAll();

    }

    public function getPrecioTotalServiciosSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT sol.id_solicitud, SUM(s.precio * se.cantidad) as 'total_servicios' FROM solicitudes sol
                        LEFT JOIN servicios_evento se on se.id_solicitud = sol.id_solicitud
                        LEFT JOIN servicios_adicionales s on s.id_servicio = se.id_servicio
                        WHERE sol.id_solicitud = $id_solicitud
                        GROUP BY sol.id_solicitud
                        LIMIT 1
        ");

        return $this->db->fetch();

    }


    public function solicitudTieneServicios($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT * FROM servicios_evento
                        WHERE id_solicitud = $id_solicitud
        ");

        if($this->db->numRows() > 0) return true;

        return false;
    }

    public function getCantidadTiposServiciosSolicitud($id_solicitud){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("SELECT * from servicios_evento
        WHERE id_solicitud = $id_solicitud
        ");

        return $this->db->numRows($this->db->fetchAll());

    }


    public function eliminarServicioSolicitud($id_solicitud, $id_servicio){

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        if(!ctype_digit("$id_servicio")) throw new ValidationException('ID de servicio no es un número');
        if($id_servicio < 1) throw new ValidationException('ID de servicio no puede ser menor que 1');

        $this->db->query("DELETE from servicios_evento
                        WHERE id_solicitud = $id_solicitud
                        AND id_servicio = $id_servicio
                        LIMIT 1
        ");

    }

}

