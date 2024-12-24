<?php

class SubjectRegistration {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch grade distribution for a specific subject
    public function getGradeDistribution($subjectCode) {
        $sql = "SELECT grade, COUNT(*) as count FROM subjectregistrations 
                WHERE subject_code = ? GROUP BY grade";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $subjectCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $grades = [];

            while ($row = $result->fetch_assoc()) {
                $grades[$row['grade']] = $row['count'];
            }

            $stmt->close();
            return $grades;
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}

?>