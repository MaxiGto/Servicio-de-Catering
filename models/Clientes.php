<?php

class Clientes extends Model{

    

    public function existeMailCliente($email){

        if(strlen($email)<6) throw new ValidationException('Correo muy corto');
        if(strlen($email)>50) throw new ValidationException('Correo muy largo');
        if(!$this->verificarEmailCliente($email)) throw new ValidationException('Correo inválido');
        $email = $this->db->escape($email);

        $this->db->query("SELECT * FROM clientes
                        WHERE email = '$email'
                        ");
        if($this->db->numRows() != 0) return false;

        return true;
    }

    public function nuevoCliente($usuario, $nombre, $apellido, $email, $telefono){

        if(strlen($nombre)<3) throw new ValidationException('Nombre muy corto');
        if(strlen($nombre)>30) throw new ValidationException('Nombre muy largo');
        $nombre = $this->db->escape($nombre);

        if(strlen($apellido)<3) throw new ValidationException('Apellido muy corto');
        if(strlen($apellido)>30) throw new ValidationException('Apellido muy largo');
        $apellido = $this->db->escape($apellido);

        if(strlen($email)<6) throw new ValidationException('Correo muy corto');
        if(strlen($email)>50) throw new ValidationException('Correo muy largo');
        if(!$this->verificarEmailCliente($email)) throw new ValidationException('Correo inválido');
        $email = $this->db->escape($email);

        if(strlen($telefono)<6) throw new ValidationException('Telefono muy corto');
        if(strlen($telefono)>15) throw new ValidationException('Telefono muy largo');
        $telefono = $this->db->escape($telefono);

        if(!$this->existeMailCliente($email)) throw new ValidationException('Email ya existe');

        $usuarioAux = new Usuarios();
        
        $usuarioDB = $usuarioAux->getUsuarioPorNombre($usuario);
        $id = $usuarioDB['id_usuario'];

        $this->db->query("INSERT INTO clientes (nombre, apellido, email, telefono, id_usuario)
                         VALUES('$nombre', '$apellido', '$email', '$telefono', $id)
                         ");

    }

    public function getClientByUserName($nombre){

        if(strlen($nombre)<3) throw new ValidationException('Nombre muy corto');
        if(strlen($nombre)>30) throw new ValidationException('Nombre muy largo');
        $nombre = $this->db->escape($nombre);

        $this->db->query("SELECT * from clientes c
                        LEFT JOIN usuarios u
                        ON c.id_usuario = u.id_usuario
                        WHERE u.usuario = '$nombre'
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function getClientByID($id){

        if(!ctype_digit("$id")) throw new ValidationException('ID de cliente no es un número');
        if($id < 1) throw new ValidationException('ID de cliente no puede ser menor que 1');

        $this->db->query("SELECT u.usuario, c.nombre, c.apellido, c.email, c.telefono from clientes c
                        LEFT JOIN usuarios u on u.id_usuario = c.id_usuario
                        WHERE c.id_cliente = $id
                        LIMIT 1
        ");

        return $this->db->fetch();

    }

    public function verificarIDCliente($id_cliente){

        if(!ctype_digit("$id_cliente")) throw new ValidationException('ID de cliente no es un número');
        if($id_cliente < 1) throw new ValidationException('ID de cliente no puede ser menor que 1');        

        $this->db->query("SELECT * FROM clientes
        WHERE id_cliente = $id_cliente
        LIMIT 1
        ");

        if($this->db->numRows() == 1) return true;

        return false;
    }

    public function verificarEmailCliente($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function usuarioEsCliente($id_usuario){

        if(!ctype_digit("$id_usuario")) throw new ValidationException('ID de usuario no es un número');
        if($id_usuario < 1) throw new ValidationException('ID de usuario no puede ser menor que 1');

        $this->db->query("SELECT * FROM clientes
        WHERE id_usuario = $id_usuario
        LIMIT 1
        ");

        if($this->db->numRows() == 1) return true;
        
        return false;

    }

    
}