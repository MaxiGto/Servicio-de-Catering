<?php

class Usuarios extends Model{

    private function validarNombreUsuario($nombre){

        if(strlen($nombre)<3) throw new ValidationException('Nombre de usuario muy corto');
        if(strlen($nombre)>30) throw new ValidationException('Nombre de usuario muy largo');
        return $this->db->escape($nombre);

    }

    public function existeNombreUsuario($nombre){

        $nombre = $this->validarNombreUsuario($nombre);

        $this->db->query("SELECT * FROM usuarios
                        WHERE usuario = '$nombre'
                        ");
        if($this->db->numRows() != 0) return false;

        return true;
    }

    public function nuevoUsuario($nombre, $password, $password2){

        if(strlen($password)<5) throw new ValidationException('Contraseña muy corta');
        if(strlen($password)>30) throw new ValidationException('Contraseña muy larga');

        if(strlen($password2)<5) throw new ValidationException('Contraseña2 muy corta');
        if(strlen($password2)>30) throw new ValidationException('Contraseña2 muy larga');

        if($password != $password2) throw new ValidationException("Las contraseñas no coinciden");

        if(!$this->existeNombreUsuario($nombre)) throw new ValidationException('Nombre de usuario ya existe');

        $password = SHA1($password);

        $this->db->query("INSERT INTO usuarios (usuario, password, rol)
                        VALUES('$nombre', '$password', 'cliente')
                        ");

    }

    public function autenticarUsuario($nombre, $password){

        if(strlen($nombre)<3) throw new ValidationException('Nombre de usuario muy corto');
        if(strlen($nombre)>30) throw new ValidationException('Nombre de usuario muy largo');
        $nombre = $this->db->escape($nombre);

        if(strlen($password)<5) throw new ValidationException('Contraseña muy corta');
        if(strlen($password)>30) throw new ValidationException('Contraseña muy larga');

        $password = SHA1($password);

        $this->db->query("SELECT *
                        FROM usuarios
                        WHERE usuario='$nombre' and password='$password'
                        LIMIT 1
        ");

        if($this->db->numRows() == 1) return true;

        return false;
    }

    public function getUsuarioPorNombre($nombre){

        $nombre = $this->validarNombreUsuario($nombre);

        $this->db->query("SELECT * FROM usuarios
                        WHERE usuario = '$nombre'
                        LIMIT 1
                        ");

        return $this->db->fetch();
    }

    public function borrarUsuario($nombre){

        $nombre = $this->validarNombreUsuario($nombre);

        $this->db->query("DELETE FROM usuarios
                        WHERE usuario = '$nombre'
                        LIMIT 1
                        ");
    }

    public function borrarUsuarioByID($id_usuario){

        if(!ctype_digit("$id_usuario")) throw new ValidationException('ID de usuario no es un número');
        if($id_usuario < 1) throw new ValidationException('ID de usuario menor que 1');

        $this->db->query("DELETE FROM usuarios
                        WHERE id_usuario = $id_usuario
                        LIMIT 1
                        ");        

    }

    public function ultimoUsuarioInsertado(){
        return $this->db->insertedID();
    }

}

class ValidationException extends Exception {}