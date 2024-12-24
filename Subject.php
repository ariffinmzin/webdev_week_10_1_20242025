<?php

class Subject {

    private $conn;

    public function __construct($db){

        $this->conn = $db;

    }

    public function getCountSubject(){

        $sql = "SELECT count(*) as total FROM subjects";
        $stmt = $this->conn->prepare($sql);

        if($stmt){

            $stmt->execute();
            $result = $stmt->get_result();

            if($result){

                $row = $result->fetch_assoc();
                return $row['total'];

            }
            else {

                return 'Error: Unable to fetch result';

            }

            $stmt->close();

        }
        else{

            return 'Error: ' . $this->conn->error;

        }
        
    }

}

?>