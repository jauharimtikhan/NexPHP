<?php

namespace App\Models;

use System\Database\Database;

class HomeModel extends Database
{
    protected static $table = "products";


    public static function getProduct()
    {
        try {
            $db = new Database();
            $table = self::$table;
            $sql = "SELECT * FROM $table";
            $db->query($sql);
            $db->execute();
            if ($db->affected_rows() > 0) {
                return $db->result_array();
            } else {
                return null;
            }
        } catch (\Exception $th) {
            throw $th;
        }
    }
}
