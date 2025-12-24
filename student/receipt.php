<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['student_id'])) {
    header('Location: ../student_login.php');
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$fee_id = $_GET['id'];
$student_id = $_SESSION['student_id'];

// Fetch fee + student details
$result = mysqli_query($conn, "
    SELECT f.*, s.name, s.room_no 
    FROM fees f
    JOIN students s ON f.student_id = s.id
    WHERE f.id='$fee_id' AND s.id='$student_id'
");
$fee = mysqli_fetch_assoc($result);

if (!$fee) {
    die("Receipt not found!");
}

// Include PDF library
require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

// Hostel Name (Moonlight Manor)
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(44, 62, 80); 
$pdf->Cell(0, 12, 'Moonlight Manor', 0, 1, 'C');
$pdf->Ln(3);

// Title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 8, 'Hostel Fee Receipt', 0, 1, 'C');
$pdf->Ln(10);

// Student & Fee Details Table
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(230, 230, 230);

// Table Header
$pdf->Cell(50, 10, 'Field', 1, 0, 'C', true);
$pdf->Cell(0, 10, 'Details', 1, 1, 'C', true);

// Table Rows
$pdf->Cell(50, 10, 'Receipt ID', 1);
$pdf->Cell(0, 10, $fee['id'], 1, 1);

$pdf->Cell(50, 10, 'Student Name', 1);
$pdf->Cell(0, 10, $fee['name'], 1, 1);

$pdf->Cell(50, 10, 'Room No', 1);
$pdf->Cell(0, 10, $fee['room_no'], 1, 1);

$pdf->Cell(50, 10, 'Amount', 1);
$pdf->Cell(0, 10, 'Rs.' . $fee['amount'], 1, 1);

$pdf->Cell(50, 10, 'Months', 1);
$pdf->Cell(0, 10, $fee['months'], 1, 1);

$pdf->Cell(50, 10, 'Payment Method', 1);
$pdf->Cell(0, 10, $fee['payment_method'], 1, 1);

$pdf->Cell(50, 10, 'Transaction ID', 1);
$pdf->Cell(0, 10, $fee['transaction_id'], 1, 1);

$pdf->Cell(50, 10, 'Payment Date', 1);
$pdf->Cell(0, 10, date('d-m-Y', strtotime($fee['payment_date'])), 1, 1);

$pdf->Cell(50, 10, 'Status', 1);
$pdf->Cell(0, 10, $fee['status'], 1, 1);

$pdf->Cell(50, 10, 'Due Date', 1);
$pdf->Cell(0, 10, date('d-m-Y', strtotime($fee['due_date'])), 1, 1);

$pdf->Ln(20);

// Thank You Note
$pdf->Cell(0, 10, 'Thank you for your payment!', 0, 1, 'C');

//fake signature with image
$pdf->Ln(15);

// Path to signature image
$signature = '../images/sign.png'; // <-- put your PNG here

// Insert signature image (align right)
$pdf->Image($signature, 145, $pdf->GetY(), 40);  // x, y, width

// Signature
$pdf->Ln(20);
$pdf->Cell(0, 10, '_________________________', 0, 1, 'R');
$pdf->Cell(0, 10, 'Authorized Signatory', 0, 1, 'R');

// Force download
$pdf->Output('D', 'receipt_' . $fee['id'] . '.pdf');
exit;
?>
