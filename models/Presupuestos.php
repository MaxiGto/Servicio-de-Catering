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

    public function getPresupuestosCliente($id_cliente){

        if(!ctype_digit("$id_cliente")) throw new ValidationException('ID de cliente no es un número');
        if($id_cliente < 1) throw new ValidationException('ID de cliente no puede ser menor que 1');

        $this->db->query("SELECT p.id_presupuesto, p.fecha, p.monto, p.monto_adicional FROM presupuestos p
                    LEFT JOIN solicitudes sol on sol.id_solicitud = p.id_solicitud
                    LEFT JOIN clientes c on c.id_cliente = sol.id_cliente
                    WHERE c.id_cliente = $id_cliente
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
        ");

        return $this->db->numRows($this->db->fetchAll());
    }

}