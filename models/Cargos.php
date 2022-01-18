<?php

class Cargos extends Model{

    public function getMontoPorHoraEncargado(){

        $this->db->query(
            "SELECT * FROM cargos
            WHERE id_cargo = 1
            LIMIT 1
            "
        );

        return $this->db->fetch();

    }

    public function getMontoPorHoraMozo(){

        $this->db->query(
            "SELECT * FROM cargos
            WHERE id_cargo = 2
            LIMIT 1
            "
        );

        return $this->db->fetch();

    }

    

}