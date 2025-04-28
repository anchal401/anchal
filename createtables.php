<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . "/anchal/index.php";

// Function to clear a table
function clearTable($dbo, $tabName) {
    $c = "DELETE FROM `$tabName`"; // Use backticks for safety
    try {
        $dbo->conn->exec($c);
    } catch (PDOException $oo) {
        echo "<br>Error clearing table $tabName: ".$oo->getMessage();
    }
}

$dbo = new Database();

// Create Tables
$tables = [
    "CREATE TABLE IF NOT EXISTS student_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        roll_no VARCHAR(20) UNIQUE,
        name VARCHAR(50)
    )",
    "CREATE TABLE IF NOT EXISTS course_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(20) UNIQUE,
        title VARCHAR(50),
        credit INT
    )",
    "CREATE TABLE IF NOT EXISTS faculty_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(20) UNIQUE,
        name VARCHAR(100),
        password VARCHAR(50)
    )",
    "CREATE TABLE IF NOT EXISTS session_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        year INT,
        term VARCHAR(50),
        UNIQUE (year, term)
    )",
    "CREATE TABLE IF NOT EXISTS course_registration (
        student_id INT,
        course_id INT,
        session_id INT,
        PRIMARY KEY(student_id, course_id, session_id)
    )",
    "CREATE TABLE IF NOT EXISTS course_allotment (
        faculty_id INT,
        course_id INT,
        session_id INT,
        PRIMARY KEY(faculty_id, course_id, session_id)
    )",
    "CREATE TABLE IF NOT EXISTS attendance_details (
        faculty_id INT,
        course_id INT,
        session_id INT,
        student_id INT,
        on_date DATE,
        status VARCHAR(20),
        PRIMARY KEY(faculty_id, course_id, session_id, student_id, on_date)
    )"
];

foreach ($tables as $query) {
    $s = $dbo->conn->prepare($query);
    try {
        $s->execute();
        echo "<br>Table created successfully.";
    } catch (PDOException $o) {
        echo "<br>Table creation failed: " . $o->getMessage();
    }
}

// Insert Students
$c = "INSERT INTO student_details (id, roll_no, name) VALUES
(1, '220800800001', 'Aahan Singh'),
(2, '222100800001', 'Anchal'),
(3, '222100800002', 'Aditya Duhan'),
(4, '222100800003', 'Akanksha'),
(5, '222100800005', 'Aman'),
(6, '222100800006', 'Anish Khan'),
(7, '222100800007', 'Anjali'),
(8, '222100800008', 'Ansh Kumar'),
(9, '222100800009', 'Anshika'),
(10, '222100800010', 'Anshul Jangra'),
(11, '222100800011', 'Apurva Bhatt'),
(12, '222100800012', 'Archana Dhiman'),
(13, '222100800015', 'Chaman Sharma'),
(14, '222100800016', 'Chhavi'),
(15, '222180080019', 'Harshit Kumar'),
(16, '222100800020', 'Irfan Khan'),
(17, '222100800021', 'Jashan'),
(18, '222100800022', 'Kajal'),
(19, '222100800023', 'Kartik'),
(20, '222100800024', 'Kashish Dalal'),
(21, '222100800025', 'Khushi'),
(22, '222100800027', 'Khush'),
(23, '221000800028', 'Love Singh'),
(24, '222100800030', 'Manish Kumar'),
(25, '222100800032', 'Manjeet Kaur'),
(26, '222100800033', 'Mohmad Vaish'),
(27, '222100800034', 'Monika Saini'),
(28, '222100800035', 'Nakita Sharma'),
(29, '222100800036', 'Neeraj Saini'),
(30, '222100800037', 'Neha'),
(31, '222100800038', 'Neha'),
(32, '222100800039', 'Nikil'),
(33, '222100800040', 'Nisha'),
(34, '222100800042', 'Pankaj'),
(35, '222100800043', 'Payal'),
(36, '222100800044', 'Purusharth Kumar'),
(37, '222100800045', 'Radha Shyam'),
(38, '222100800047', 'Rajesh Kumar'),
(39, '222100800048', 'Rajni Devi'),
(40, '222100800052', 'Sahil'),
(41, '222100800053', 'Sakshi Sharma'),
(42, '222100800054', 'Saloni'),
(43, '222100800055', 'Samriti Sharma'),
(44, '222100800056', 'Sandeep'),
(45, '222100800059', 'Shobhit Chamola'),
(46, '222100800060', 'Simran'),
(47, '222100800061', 'Sujal'),
(48, '222100800062', 'Tannu'),
(49, '222100800064', 'Vaibhav'),
(50, '222100800065', 'Vikram'),
(51, '222100800066', 'Viren'),
(52, '222100823001', 'Amit Singh'),
(53, '222100823002', 'Bipashu Kumar'),
(54, '222100823003', 'Gagandeep'),
(55, '222100823004', 'Harshpreet Kaur'),
(56, '222100823005', 'Jagdish'),
(57, '222100823006', 'Khushi'),
(58, '222100823007', 'Punit Kumar'),
(59, '222100823008', 'Surender Kumar'),
(60, '222100823009', 'Vikas Gaur'),
(61, '222100823010', 'Yunus Khan')";

try {
    $dbo->conn->exec($c);
    echo "<br>Students inserted.";
} catch (PDOException $o) {
    echo "<br>Duplicate student entry.";
}

// Insert Faculties
$c = "INSERT INTO faculty_details (id, user_name, password, name) VALUES
(1, 'Amita', '123', 'Amita Ranghuvanshi'),
(2, 'Ravinder', '123', 'Ravinder Sheron'),
(3, 'Suman', '123', 'Suman Chaudhary'),
(4, 'Aruna', '123', 'Aruna Goel'),
(5, 'Dharmveer', '123', 'Dharmveer Saini'),
(6, 'Shabnam', '123', 'Shabnam')";

try {
    $dbo->conn->exec($c);
    echo "<br>Faculties inserted.";
} catch (PDOException $o) {
    echo "<br>Duplicate faculty entry.";
}

// Insert Sessions
$c = "INSERT INTO session_details (id, year, term) VALUES
(1, 2025, 'Spring Semester'),
(2, 2025, 'Autumn Semester')";

try {
    $dbo->conn->exec($c);
    echo "<br>Sessions inserted.";
} catch (PDOException $o) {
    echo "<br>Duplicate session entry.";
}

// Insert Courses
$c = "INSERT INTO course_details (id, code, title, credit) VALUES
(1, 'DBMS', 'Database Management System', 4),
(2, '123B', 'Data Structure Using C', 3),
(3, '234C', 'Programming Using C', 4),
(4, '678D', 'COA', 4),
(5, '890', 'Software Engineering', 3)";

try {
    $dbo->conn->exec($c);
    echo "<br>Courses inserted.";
} catch (PDOException $o) {
    echo "<br>Duplicate course entry.";
}

// Insert Course Registrations
clearTable($dbo, "course_registration");

$c = "INSERT INTO course_registration (student_id, course_id, session_id) VALUES (:sid, :cid, :sessid)";
$s = $dbo->conn->prepare($c);

for ($i = 1; $i <= 61; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $cid = rand(1, 5);
        try {
            $s->execute([":sid" => $i, ":cid" => $cid, ":sessid" => 1]);
            $s->execute([":sid" => $i, ":cid" => $cid, ":sessid" => 2]);
        } catch (PDOException $pe) {
            // Skip duplicates
        }
    }
}

// Insert Course Allotments
clearTable($dbo, "course_allotment");

$c = "INSERT INTO course_allotment (faculty_id, course_id, session_id) VALUES (:fid, :cid, :sessid)";
$s = $dbo->conn->prepare($c);

for ($i = 1; $i <= 6; $i++) {
    for ($j = 0; $j < 2; $j++) {
        $cid = rand(1, 5);
        try {
            $s->execute([":fid" => $i, ":cid" => $cid, ":sessid" => 1]);
            $s->execute([":fid" => $i, ":cid" => $cid, ":sessid" => 2]);
        } catch (PDOException $pe) {
            // Skip duplicates
        }
    }
}

echo "<br>Database initialized successfully.";
?>

  
