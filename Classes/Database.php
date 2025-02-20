<?php

class Database {
    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbName = DB_NAME;

    public $link;
    public $error;

    public function __construct() {
        $this->connectDB();
    }
    private function connectDB() {

       $this->link =  new mysqli($this->host, $this->user, $this->pass, $this->dbName);
       if($this->link) {
        $this->error = "Connection Fail".$this->link->connect_error;
        return false;
    }
    }

    public function selectData($query) {
    $result = $this->link->query($query) or die($this->link->error.__LINE__);

    if($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }

    }

    public function insertData($query) {
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

        if($insert_row) {
            header("location: index.php?msg=".urlencode('Data Inserted Successfully.'));
            exit();
        } else {
            die("Error:(".$this->link->errno.")".$this->link->error);
        }


    }
    public function updateData($query) {
        $updateRow = $this->link->query($query) or die($this->link->error.__LINE__);

        if($updateRow) {
            header("location: index.php?msg=".urlencode('Data Updated Successfully.'));
            exit();
        } else {
            die("Error:(".$this->link->errno.")".$this->link->error);
        }


    }
    public function deleteUser($query) {
        $updateRow = $this->link->query($query) or die($this->link->error.__LINE__);

        if($updateRow) {
            header("location: index.php?msg=".urlencode('Data Deleted Successfully.'));
            exit();
        } else {
            die("Error:(".$this->link->errno.")".$this->link->error);
        }


    }
}