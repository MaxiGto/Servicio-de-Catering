<?php

// fw/View.php

abstract class View{

    public function mostrarMensaje($m){
        
        echo '<div><p class="mensaje">' . $m . '</p></div>';
    }

    public function mostrarMensajeError($e){
        
        echo '<div><p class="mensaje error">' . $e . '</p></div>';
    }
  
    public function render(){

        include '../html/' . get_class($this) . '.php';

    }

}

?>