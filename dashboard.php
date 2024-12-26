<?php

    include 'Database.php';
    include 'Subject.php';
    include 'User.php';
    include 'SubjectRegistration.php';
    
    $database = new Database();
    $db = $database->getConnection();

    $subject = new Subject($db);
    $totalNumberOfSubjects = $subject->getCountSubject();

    $user = new User($db);
    // $totalNumberOfStudents = $user->getCountStudent();
    // $totalNumberOfLecturers = $user->getCountLecturer();
    $totalNumberOfStudents = $user->getCountRole('student');
    $totalNumberOfLecturers = $user->getCountRole('lecturer');
    $roleDistribution = $user->getRoleDistribution();

    $roles = json_encode(array_keys($roleDistribution));
    $countRoles = json_encode(array_values($roleDistribution));

    // echo $roles;
    // echo $countRoles;

    $subjectRegistration = new SubjectRegistration($db);
    $gradeDistribution = $subjectRegistration->getGradeDistribution('BIC21203'); // Web Development subject code

    // Prepare grade data for Chart.js
    $grades = json_encode(array_keys($gradeDistribution));
    $counts = json_encode(array_values($gradeDistribution));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Subjects

                    </div>
                    <div class="card-body">

                        <?php echo $totalNumberOfSubjects; ?>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Students

                    </div>
                    <div class="card-body">

                        <?php echo $totalNumberOfStudents; ?>

                    </div>
                </div>


            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        Total Lecturers

                    </div>
                    <div class="card-body">

                        <?php echo $totalNumberOfLecturers; ?>

                    </div>
                </div>


            </div>
            
        
        </div>
        
            <!-- Chart for Grade Distribution -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Grade Distribution for Web Development</div>
                    <div class="card-body">
                        <canvas id="gradeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Student/Lecturer Distribution</div>
                    <div class="card-body">
                        <div style="max-width: 400px; margin: auto;">
                            <canvas id="rolePieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    
    <script>
        // Data for Chart.js
        const grades = <?php echo $grades; ?>;
        const counts = <?php echo $counts; ?>;

        // const ctx = document.getElementById('gradeChart').getContext('2d');
        new Chart('gradeChart', {
            type: 'bar',
            data: {
                labels: grades, // X-axis labels (grades)
                datasets: [{
                    label: 'Number of Students',
                    data: counts, // Y-axis data (counts)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Grade Distribution for Web Development'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<script>
        const roles = <?php echo $roles; ?>;
        const countRoles = <?php echo $countRoles; ?>;
        // Data for Chart.js
        // const ctx = document.getElementById('rolePieChart').getContext('2d');
        new Chart('rolePieChart', {
            type: 'pie',
            data: {
                labels: roles, // Labels for pie chart
                datasets: [{
                    data: countRoles, // Data for each slice
                    backgroundColor: ['#FF6384', '#36A2EB'], // Customize colors as needed
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Student/Lecturer Distribution'
                    }
                }
            }
        });
    </script>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>