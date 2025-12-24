<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

$sql = "SELECT complaints.id, complaints.complaint, complaints.status, complaints.created_at, students.name 
        FROM complaints 
        JOIN students ON complaints.student_id = students.id 
        ORDER BY complaints.created_at";

$result = $conn->query($sql);
?>

<style>

    select 
    {
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.2);
        background: rgba(255,255,255,0.05);
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
        margin-right: 10px;
    }

    select option 
    {
        background: #0f0f1a; /* dark dropdown background */
        color: #fff;
    }

    select:focus 
    {
        outline: none;
        border-color: #00eaff;
        box-shadow: 0 0 8px rgba(0,234,255,0.6);
    }

</style>

<div class="fee-records">
    <h2 class="add"><i class="fa-solid fa-envelope-open-text"></i> All Student Complaints</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th><th>Student</th><th>Complaint</th><th>Status</th><th>Date</th><th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['complaint']) ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= date('d-m-Y h:i', strtotime($row['created_at'])) ?></td>
                <td>

                <form method="POST" action="dashboard.php?page=update_status">
                
                <input type="hidden" name="complaint_id" value="<?= $row['id'] ?>">
    
                <select name="status">
                    <option value="Pending" <?= $row['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="In Progress" <?= $row['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="Resolved" <?= $row['status'] === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                </select>
                
                <input type="submit" class="btn" value="Update">
                </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>   