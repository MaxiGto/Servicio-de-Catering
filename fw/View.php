<?php

// fw/View.php

abstract class View{

    public function mostrarMensaje($m){
        
        echo '<p>' . $m . '</p>';
    }

    public function mostrarMensajeError($e){
        
        echo '<p class="mensaje-error">' . $e . '</p>';
    }
  
    public function render(){

        include '../html/' . get_class($this) . '.php';

    }

}

?>