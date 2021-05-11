<?php

class Database {

    private $connection;

    public function __construct($host, $user, $pass, $database)
    {

        $result = new mysqli($host, $user, $pass, $database);

 
        if($result->connect_error) {
            die('Could not connect: ' . $result->connect_error);
        }


        $this->connection = $result;
    }


    public function get_imena() {

        $imena = [];

        try {

            
            $results = $this->connection->query("SELECT * FROM ime_prezime");

            if($results->num_rows > 0) {
                $imena = $results->fetch_all(MYSQLI_ASSOC); 
            }

            return $imena;
        
        } catch(Exception $e) {
            die($e->getMessage());
        }

    }

    public function insert_imena($params) {

        try {

            
            $ime = $params['imePrezime'];

            $statement = $this->connection->prepare(
                "INSERT INTO ime_prezime (imePrezime) VALUES (?)"
            );

            $statement->bind_param("s", $ime);

            $result = $statement->execute();

            header('Location: index.php');

        } catch(Exception $e) {
            echo $e->getMessage();
        }

    }

    public function delete_ime($id) {

        $id = $_GET['id'];

        $statement = $this->connection->prepare("DELETE FROM ime_prezime WHERE id=$id");

        $result = $statement->execute();

        header("Location: index.php");

    }

    public function get_ime($id) {

        $ime = [];

        try {

            $results = $this->connection->query("SELECT * FROM ime_prezime WHERE id=$id");

            if($results->num_rows > 0) {
                $ime = $results->fetch_all(MYSQLI_ASSOC); 
            }

            return $ime;
        
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }


    public function update_ime($id) {

            $ime = $_GET['imePrezime'];

            $statement = $this->connection->prepare("UPDATE ime_prezime SET imePrezime='$ime' WHERE id=$id");

            $result = $statement->execute();

            header("Location: index.php");
        }


}


?>