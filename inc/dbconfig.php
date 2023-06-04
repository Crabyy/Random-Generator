<?php

class Database {

    protected function conn() {
        try {
            $dbuser = "root";
            $dbpass = "";
            $dbh = new PDO('mysql:host=localhost;dbname=personal_base', $dbuser, $dbpass);
            return $dbh;
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
        }

    }

    public function getConnection() {
        return $this->conn();
    }

}