<?php

class User
{
    private $conn;
    // Constructor to initialize the database connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // CREATE a new user
    public function createUser($matric, $name, $password, $role)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $matric, $name, $password, $role); // s - string, i - integer
            $result = $stmt->execute();

            if ($result) {
                // return true;
                echo "<script>
                alert('User registered successfully');
                window.location.href = 'layout.php?page=register';
              </script>";
                exit; // Ensure no further code is executed
                
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
        return "Error: " . $this->conn->error;
        }
    }

    // READ all users
    public function getUsers()
    {
        $sql = "SELECT matric, name, role FROM users";
        $result = $this->conn->query($sql);
        return $result;
    }

    // READ a single user by matric
    public function getUser($matric)
    {
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // UPDATE a user's information
    public function updateUser($matric, $name, $role)
    {
        $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $name, $role, $matric);
            $result = $stmt->execute();
        if ($result) {
            // return true;
            echo "<script>alert('Update is successful')</script>";
            echo "<script>window.location.href='layout.php?page=read'</script>";
        } else {
            return "Error: " . $stmt->error;
        }
        } else {
            $stmt->close();
            return "Error: " . $this->conn->error;
        }
    }

    // DELETE a user by matric
    public function deleteUser($matric)
    {
        $sql = "DELETE FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $result = $stmt->execute();
            if ($result) {
                echo "<script>alert('Data deleted successfully')</script>";
                echo "<script>window.location.href='read.php'</script>";
            } else {
                return "Error: " . $stmt->error;
            }
        } else {
            $stmt->close();
            return "Error: " . $this->conn->error;
        }
    }

    public function getCountRole($role){

        $sql = "SELECT count(*) AS total FROM users where role=?";
        $stmt = $this->conn->prepare($sql);
        
        if($stmt){
            $stmt->bind_param("s", $role);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result){

                $row = $result->fetch_assoc();
                return $row['total'];
            }
            else{

                return 'Error: Unable to fetch result';
            }
            $stmt->close();
        }
        else{

            return 'Error: ' . $this->conn->error;
        }

    }

    public function getRoleDistribution() {
        $sql = "SELECT role, COUNT(*) as count FROM users 
                GROUP BY role";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $roles = [];

            while ($row = $result->fetch_assoc()) {
                $roles[$row['role']] = $row['count'];
            }

            $stmt->close();
            return $roles;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // public function getCountStudent(){

    //     $sql = "SELECT count(*) AS total FROM users where role='student'";
    //     $stmt = $this->conn->prepare($sql);

    //     if($stmt){
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         if($result){

    //             $row = $result->fetch_assoc();
    //             return $row['total'];
    //         }
    //         else{

    //             return 'Error: Unable to fetch result';
    //         }
    //         $stmt->close();
    //     }
    //     else{

    //         return 'Error: ' . $this->conn->error;
    //     }

    // }

    // public function getCountLecturer(){

    //     $sql = "SELECT count(*) AS total FROM users where role='lecturer'";
    //     $stmt = $this->conn->prepare($sql);

    //     if($stmt){
    //         $stmt->execute();
    //         $result = $stmt->get_result();

    //         if($result){

    //             $row = $result->fetch_assoc();
    //             return $row['total'];
    //         }
    //         else{

    //             return 'Error: Unable to fetch result';
    //         }
    //         $stmt->close();
    //     }
    //     else{

    //         return 'Error: ' . $this->conn->error;
    //     }

    // }
    

}



?>