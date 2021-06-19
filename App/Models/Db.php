<?php 

abstract class Db{
    
    abstract public function save();

    abstract public function remove($id);

    abstract public function find($id);
    
}

?>