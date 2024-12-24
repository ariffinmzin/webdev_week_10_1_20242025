<?php
class Database {
    private $host = "127.0.0.1";
    private $db_name = "webdev_week_10_1_20242025";
    private $username = "root";
    private $password = "";
    public $conn;
    // Method to get the database connection
    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        // Check the connection
        if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
        } else {
        // echo "Connected successfully";
        }
        return $this->conn;
    }
}