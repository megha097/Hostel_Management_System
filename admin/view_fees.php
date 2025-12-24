<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

// Fetch fees with student info
$result = mysqli_query($conn, "
    SELECT f.id, f.amount, f.months, f.status, f.due_date, s.name AS student_name, s.room_no
    FROM fees f
    JOIN students s ON f.student_id = s.id
    ORDER BY s.room_no ASC
");
?>

<div class="fee-records">
    <h2 class="add"><i class="fa-solid fa-wallet"></i> Fee Records</h2>
</div>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Student (Room)</th>
            <th>Amount</th>
            <th>Months</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Actions</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['student_name']) ?> (Room <?= $row['room_no'] ?>)</td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['months'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= date('d-m-Y', strtotime($row['due_date'])) ?></td>
            <td>
                <a href="dashboard.php?page=edit_fee&id=<?= $row['id'] ?>" class="btn">Edit</a> | 
                <a href="delete_fee.php?id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Delete this fee record?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table><br>
    
    <a href="export_fees.php" class="btn">📥 Export to Excel</a>
</div>