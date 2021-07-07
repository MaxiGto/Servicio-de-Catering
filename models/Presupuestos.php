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

    public function verificarIDPresupuesto($id_presupuesto){

        if(!ctype_digit("$id_presupuesto")) throw new ValidationException('ID de presupuesto no es un número');
        if($id_presupuesto < 1) throw new ValidationException('ID de presupuesto no puede ser menor que 1');        

        $this->db->query("SELECT * FROM presupuestos
        WHERE id_presupuesto = $id_presupuesto
        LIMIT 1
        ");

    $res = $this->db->fetch();

    if($this->db->numRows($res) == 1 && $res['aceptado'] == NULL) return true;

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

}