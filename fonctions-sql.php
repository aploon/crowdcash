<?php

    function insert($table, $column_value, PDO $db){
        $columns = [];
        $values = [];
        foreach($column_value as $column => $value){
            $columns[] = $column;
            $values[] = "'".$value."'";
        }

        $query = "INSERT INTO ".$table." (".implode(',',$columns).") VALUES (".implode(',',$values).")";
        if($db->query($query))
            return true;
        else
            return false;

    }
    function insert1($table, $column_value, PDO $db){
        $columns = [];
        $values = [];
        foreach($column_value as $column => $value){
            $columns[] = $column;
            $values[] = "'".$value."'";
        }

        $query = "INSERT INTO ".$table." (".implode(',',$columns).") VALUES (".implode(',',$values).")";
        // if($db->query($query))
        //     return true;
        // else
        //     return false;
        return $query;

    }

    function update($table, $column_value, $condition, $db){
        $column_value_normal_for_requete = [];
        foreach($column_value as $column => $value){
            $column_value_normal_for_requete[] = $column." = '".$value."'";
        }
        $query = "UPDATE ".$table." SET ".implode(' , ',$column_value_normal_for_requete)." WHERE ".$condition;
        if($db->query($query))
            return true;
        else
            return false;
    }

    function update1($table, $column_value, $condition, $db){
        $column_value_normal_for_requete = [];
        foreach($column_value as $column => $value){
            $column_value_normal_for_requete[] = $column." = '".$value."'";
        }
        $query = "UPDATE ".$table." SET ".implode(' , ',$column_value_normal_for_requete)." WHERE ".$condition;
        
        return $query;
    }

    function delete($table, $condition, $db){
        $query = "DELETE FROM ".$table." WHERE ".$condition;
        if($db->query($query))
            return true;
        else
            return false;
    }


?>