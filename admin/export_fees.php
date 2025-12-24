<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

// Fetch all fee records with student info
$result = mysqli_query($conn, "
    SELECT f.id, s.room_no, s.name AS student_name, f.amount, f.status, f.due_date
    FROM fees f
    JOIN students s ON f.student_id = s.id
    ORDER BY s.room_no ASC
");

// Set headers to download file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=fee_records.csv');

// Create a file pointer connected to output stream
$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, array('ID', 'Room No', 'Student Name', 'Amount', 'Status', 'Due Date'));

// Output each row
while ($row = mysqli_fetch_assoc($result)) 
{
    fputcsv($output, array( 
        $row['id'],
        $row['room_no'],
        $row['student_name'],
        $row['amount'],
        $row['status'],
        "'".$row['due_date']."' " // force Excel to treat it as text
    ));
}

fclose($output);
exit();
?>