<?php
//session_start();
include('../db.php');

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: ../student_login.php');
    exit();
}

// Get student_id from session
$student_id = $_SESSION['student_id'];

// Fetch this student's fees using student_id
$result = mysqli_query($conn, "
    SELECT f.id, f.amount, f.months, f.status, f.due_date, s.room_no
    FROM fees f
    JOIN students s ON f.student_id = s.id
    WHERE f.student_id = '$student_id'
    ORDER BY f.due_date ASC
");

// Get today's date for overdue check
$today = date('d-m-Y');
?>
   
<style>
/* Overdue row background */
.overdue-row {
    background: rgba(255,255,255,0.08);
}

/* Hover effect for overdue row */
.overdue-row:hover {
    background: rgba(0,234,255,0.08);
}
</style> 
 
    <div class="fee-records">
    <h2 class="add"><i class="fa-solid fa-wallet"></i> My Fee Records</h2>
</div>

    <table border="1" cellpadding="10">
        <tr>
            <th>Room No</th>
            <th>Amount</th>
            <th>Months</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            // Color-code status
            $statusColor = ($row['status'] == 'Paid') ? 'lightgreen' : 'red';

            // Check if overdue
            $overdue = ($row['status'] != 'Paid' && $row['due_date'] < $today) ? true : false;
        ?>
        <tr class="<?= $overdue ? 'overdue-row' : '' ?>">
            <td><?= $row['room_no'] ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['months'] ?></td>
            <td style="color: <?= $statusColor ?>; font-weight: bold;">
                <?= $row['status'] ?>
            </td>
            <td><?= date('d-m-Y', strtotime($row['due_date'])) ?></td>
            <td>
                <?php if ($row['status'] != 'Paid') { ?>
                    <a href="student_dashboard.php?page=pay_fee&id=<?= $row['id'] ?>" class="btn">Pay Now</a>
                <?php } else { ?>
                     <a href="receipt.php?id=<?= $row['id'] ?>" class="btn">Download Receipt</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table><br>
    <!-- <a href="student_dashboard.php">Back To Dashboard</a> -->