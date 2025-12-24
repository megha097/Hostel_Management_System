<?php
include('../db.php');

// Summary counts
$total_students = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];
$total_rooms = $conn->query("SELECT COUNT(*) as total FROM rooms")->fetch_assoc()['total'];
$total_complaints = $conn->query("SELECT COUNT(*) as total FROM complaints")->fetch_assoc()['total'];

$result = $conn->query("SELECT * FROM students");

// Fee summary counts
$totalPaid = $conn->query("SELECT SUM(amount) as total FROM fees WHERE status='Paid'")->fetch_assoc()['total'];
$totalUnpaid = $conn->query("SELECT SUM(amount) as total FROM fees WHERE status='Unpaid'")->fetch_assoc()['total'];
$countPaid = $conn->query("SELECT COUNT(*) as count FROM fees WHERE status='Paid'")->fetch_assoc()['count'];
$countUnpaid = $conn->query("SELECT COUNT(*) as count FROM fees WHERE status='Unpaid'")->fetch_assoc()['count'];
?>
    <div>
        <h3><i class="fa-solid fa-gauge-high"></i> Dashboard Summary</h3><br>
                    
        <hr><br>
        <div class="cards">
        <div class="card">
            <h4><i class="fa-solid fa-user-graduate"></i> Total Students </h4>
            <p><?= $total_students ?></p>
        </div>
        <div class="card">
            <h4><i class="fa-solid fa-bed"></i> Total Rooms </h4>
            <p><?= $total_rooms ?></p>
        </div>
        <div class="card">
            <h4><i class="fa-solid fa-comments"></i> Total Complaints</h4>
            <p><?= $total_complaints ?></p>
        </div>
    </div>

        <!-- Fee Summary Cards Start -->
        <h3><i class="fa-solid fa-wallet"></i>  Fee Summary</h3><br><hr><br>
                <div class="cards">
                <div class="card">
                    <h4><i class="fa-solid fa-sack-dollar" style="color:gold;"></i> Total Collected</h4>
                    <p style="color:lightgreen;">₹<?= $totalPaid ? $totalPaid : 0 ?></p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-circle-xmark" style="color:#ff4d4d;"></i> Pending Fees</h4>
                    <p style="color:#ff4d4d;">₹<?= $totalUnpaid ? $totalUnpaid : 0 ?></p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-circle-check" style="color:lightgreen;"></i> Paid Records</h4>
                    <p style="color:lightgreen;"><?= $countPaid ?></p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-circle-exclamation" style="color:orange;"></i> Unpaid Records</h4>
                    <p style="color:orange;"><?= $countUnpaid ?></p>
                </div>
            </div>

        <!-- Fee Summary Cards End -->

        <hr><br>

        <h3><i class="fa-solid fa-user-graduate"></i> All Students</h3>
        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Room</th><th>Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= $row['room_no'] ?></td>
                    <td>
                        <a href="dashboard.php?page=edit_student&id=<?= $row['id'] ?>" class="btn" class="<?= basename($_SERVER['PHP_SELF']) == 'edit_student.php' ? 'active' : '' ?>">Edit</a>
 | 
                        <a href="delete_student.php?id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Delete this student?')">Delete</a><br><br>
                    </td>
                </tr>
            <?php } ?>
        </table>