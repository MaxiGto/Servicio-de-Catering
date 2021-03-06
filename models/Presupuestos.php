<?php

class Presupuestos extends Model{

    public function savePresupuesto($monto, $adicional, $horasAd, $precioHorasAd, $observaciones, $id_solicitud){

        if(!is_numeric($monto)) throw new ValidationException('Monto no es un número');
        if($monto <= 0) throw new ValidationException('El monto debe ser mayor a 0');

        if(!is_numeric($adicional)) throw new ValidationException('Monto adicional no es un número');
        if($adicional < 0) throw new ValidationException('El monto adicional debe ser mayor o igual a 0');

        if(!ctype_digit("$horasAd")) throw new ValidationException('Cantidad de horas no es un número');
        if($horasAd < 0) throw new ValidationException('Cantidad de horas no puede ser menor que 0'); 
        
        if(!is_numeric($precioHorasAd)) throw new ValidationException('Monto hora adicional no es un número');
        if($precioHorasAd < 0) throw new ValidationException('El monto hora adicional debe ser mayor o igual a 0');

        $observaciones = substr($observaciones, 0, 300);
        $observaciones = $this->db->escape($observaciones);
        $observaciones = htmlentities($observaciones);

        if(!ctype_digit("$id_solicitud")) throw new ValidationException('ID de solicitud no es un número');
        if($id_solicitud < 1) throw new ValidationException('ID de solicitud no puede ser menor que 1');

        $this->db->query("INSERT INTO presupuestos(fecha, monto, monto_adicional, horasAd, precio_horasAd, observaciones, id_solicitud)
                        VALUES (NOW(), $monto, $adicional, $horasAd, $precioHorasAd, '$observaciones', $id_solicitud)

        ");
    }

    public function verificarIDPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');        

        $this->db->query("SELECT * FROM presupuestos
        WHERE id_presupuesto = $id_presupuesto
        LIMIT 1
        ");

        $res = $this->db->fetch();

        if($this->db->numRows($res) == 1) return true;

        return false;
    }

    public function verificarPresupuestoPendiente($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');        

        $this->db->query("SELECT * FROM presupuestos
        WHERE id_presupuesto = $id_presupuesto
        LIMIT 1
        ");

        $res = $this->db->fetch();

        if($res['aceptado'] == NULL) return true;

        return false;
    }

    public function verificarPresupuestoAceptado($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');        

        $this->db->query("SELECT * FROM presupuestos
        WHERE id_presupuesto = $id_presupuesto
        LIMIT 1
        ");

        $res = $this->db->fetch();

        if($res['aceptado'] == 'Y') return true;

        return false;
    }

    public function verificarPresupuestoCliente($id_presupuesto, $id_cliente){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');
        
        if(!ctype_digit("$id_cliente")) throw new ValidationException('ID de cliente no es un número');
        if($id_cliente < 1) throw new ValidationException('ID de cliente no puede ser menor que 1');   
        
        $this->db->query("SELECT c.id_cliente from presupuestos p
                        INNER JOIN solicitudes sol ON sol.id_solicitud = p.id_solicitud
                        INNER JOIN clientes c ON c.id_cliente = sol.id_cliente
                        WHERE p.id_presupuesto = $id_presupuesto
                        LIMIT 1
        ");

        $res = $this->db->fetch();

        if($this->db->numRows($res) == 1 && $res['id_cliente'] == $id_cliente) return true;

        return false;
    }

    public function getPresupuestoByID($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');        

        $this->db->query("SELECT * FROM presupuestos
                        WHERE id_presupuesto = $id_presupuesto
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function getPresupuestosCliente($id_cliente){

        if(!ctype_digit("$id_cliente")) throw new ValidationException('ID de cliente no es un número');
        if($id_cliente < 1) throw new ValidationException('ID de cliente no puede ser menor que 1');

        $this->db->query("SELECT p.id_presupuesto, p.fecha, p.monto, p.monto_adicional FROM presupuestos p
                    LEFT JOIN solicitudes sol on sol.id_solicitud = p.id_solicitud
                    LEFT JOIN clientes c on c.id_cliente = sol.id_cliente
                    WHERE c.id_cliente = $id_cliente
                    AND p.aceptado is NULL
        ");

        return $this->db->fetchAll();

    }

    public function getCantidadPresupuestosCliente($id_cliente){

        if(!ctype_digit("$id_cliente")) throw new ValidationException('ID de cliente no es un número');
        if($id_cliente < 1) throw new ValidationException('ID de cliente no puede ser menor que 1');

        $this->db->query("SELECT p.id_presupuesto, p.fecha, p.monto, p.monto_adicional FROM presupuestos p
                    LEFT JOIN solicitudes sol on sol.id_solicitud = p.id_solicitud
                    LEFT JOIN clientes c on c.id_cliente = sol.id_cliente
                    WHERE c.id_cliente = $id_cliente
                    AND p.aceptado is NULL
        ");

        return $this->db->numRows($this->db->fetchAll());
    }

    public function getMenusPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("SELECT m.id_menu, m.nombre , m.precio, me.cantidad, (m.precio * me.cantidad) as total FROM presupuestos p
                        LEFT JOIN menus_evento me on me.id_solicitud = p.id_solicitud
                        LEFT JOIN menus m on m.id_menu = me.id_menu
                        WHERE p.id_presupuesto = $id_presupuesto
        ");

        return $this->db->fetchAll();

    }

    public function getTotalMenusPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("SELECT p.id_presupuesto, SUM(cantidad) as 'total' 
                        FROM menus_evento me
                        LEFT JOIN presupuestos p on p.id_solicitud = me.id_solicitud
                        WHERE me.id_solicitud = (SELECT id_solicitud FROM presupuestos
                        WHERE id_presupuesto = $id_presupuesto)
                        GROUP BY p.id_presupuesto
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function getPrecioTotalMenusPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("SELECT p.id_presupuesto, SUM(m.precio * me.cantidad) as 'total_menus' FROM presupuestos p
                        LEFT JOIN menus_evento me on me.id_solicitud = p.id_solicitud
                        LEFT JOIN menus m on m.id_menu = me.id_menu
                        WHERE p.id_presupuesto = $id_presupuesto
                        GROUP BY p.id_presupuesto
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function presupuestoTieneServicios($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("SELECT * FROM servicios_evento
                        WHERE id_solicitud = (SELECT id_solicitud FROM presupuestos
                        WHERE id_presupuesto = $id_presupuesto)
        ");

        if($this->db->numRows() > 0) return true;

        return false;
    }

    public function getServiciosPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("SELECT s.id_servicio, s.nombre , s.precio, se.cantidad, (s.precio * se.cantidad) as total FROM presupuestos p
                        LEFT JOIN servicios_evento se on se.id_solicitud = p.id_solicitud
                        LEFT JOIN servicios_adicionales s on s.id_servicio = se.id_servicio
                        WHERE p.id_solicitud = (SELECT id_solicitud FROM presupuestos
                        WHERE id_presupuesto = $id_presupuesto)
        ");

        return $this->db->fetchAll();

    }

    public function getPrecioTotalServiciosPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("SELECT p.id_presupuesto, SUM(s.precio * se.cantidad) as 'total_servicios' FROM presupuestos p
                        LEFT JOIN servicios_evento se on se.id_solicitud = p.id_solicitud
                        LEFT JOIN servicios_adicionales s on s.id_servicio = se.id_servicio
                        WHERE p.id_solicitud = (SELECT id_solicitud FROM presupuestos
                        WHERE id_presupuesto = $id_presupuesto)
                        GROUP BY p.id_presupuesto
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function presupuestoAceptado($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("UPDATE presupuestos
                        SET aceptado = 'Y'
                        WHERE id_presupuesto = $id_presupuesto
        ");

    }

    public function presupuestoRechazado($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');

        $this->db->query("UPDATE presupuestos
                        SET aceptado = 'N'
                        WHERE id_presupuesto = $id_presupuesto
        ");

    }
    
    public function getCantidadPresupuestosAConfirmar(){

        $this->db->query("SELECT *
                        FROM presupuestos p
                        WHERE aceptado is NULL
        ");

        return $this->db->numRows();

    }

    public function getPresupuestosAConfirmar(){

        $this->db->query("SELECT p.id_presupuesto, p.fecha, p.aceptado, p.id_solicitud, s.id_cliente
                        FROM presupuestos p
                        JOIN solicitudes s
                        ON p.id_solicitud = s.id_solicitud
                        WHERE p.aceptado is NULL
        ");

        return $this->db->fetchAll();

    }

    public function getPresupuestosAceptados(){

        $this->db->query("SELECT *
                        FROM presupuestos p
                        WHERE aceptado = 'Y'
                        AND id_solicitud NOT IN
                        (SELECT id_solicitud FROM eventos)
        ");

        return $this->db->fetchAll();

    }

    public function getCantidadPresupuestosAceptados(){

        $this->db->query("SELECT *
                        FROM presupuestos p
                        WHERE aceptado = 'Y'
                        AND id_solicitud NOT IN
                        (SELECT id_solicitud FROM eventos)
        ");

        return $this->db->numRows();

    }

    public function getIDSolicitudPresupuesto($id_presupuesto){

        $this->db->query("SELECT id_solicitud
                        FROM presupuestos p 
                        WHERE p.id_presupuesto = $id_presupuesto
                        LIMIT 1

        ");

        return $this->db->fetch();

    }

    public function getSolicitudPresupuesto($id_presupuesto){

        $this->db->query("SELECT *
                        FROM presupuestos p
                        JOIN solicitudes s
                        ON p.id_solicitud = s.id_solicitud
                        WHERE p.id_presupuesto = $id_presupuesto
                        LIMIT 1

        ");

        return $this->db->fetch();

    }

}