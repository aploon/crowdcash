<?php 

    function connected() {
        if(isset($_SESSION['id_compte'])) {
            return true;
        } else {
            return false;
        }
    }

    function dump($variable){
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }
    
    function si_funct($a, $b, $c, $d){
        if($a == $b)
            return $c;
        else
            return $d;
    }

    function si_funct1($a, $b, $c){
        if($a)
            return $b;
        else
            return $c;
    }


    function select($propriete, $table, $db, $selected = '', $condition = '') : string {

        $query = "SELECT DISTINCT $propriete FROM $table $condition";
        $statement = $db->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();

        

        $output = '';

        foreach ($result as $row) {
            $attributes = ($selected == $row[$propriete]) ? 'selected' : '';
            $output .= '<option value="'.$row[''.$propriete.''].'" '.$attributes.'>'.$row[''.$propriete.''].'</option>'; 
        }

        return $output;
        
    }

    function select1($propriete, $table, $value, $db, $selected = '', $condition = '') : string {

        $query = "SELECT DISTINCT * FROM $table $condition";
        $statement = $db->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll();

        

        $output = '';

        foreach ($result as $row) {
            $attributes = ($selected == $row[$propriete]) ? 'selected' : '';
            $output .= '<option value="'.$row[''.$value.''].'" '.$attributes.'>'.$row[''.$propriete.''].'</option>'; 
        }

        return $output;
        
    }