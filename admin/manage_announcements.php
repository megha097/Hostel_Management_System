<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

// Handle new announcement submission
if (isset($_POST['title'], $_POST['message'])) 
{
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    mysqli_query($conn, "INSERT INTO announcements (title, message) VALUES ('$title', '$message')");
    header("Location: dashboard.php?page=manage_announcements");
    exit();
}

// Fetch all announcements
$announcements = $conn->query("SELECT * FROM announcements ORDER BY created_at");
?>

<div class="announcements">

    <h2 class="add"><i class="fa-solid fa-bullhorn"></i> Manage Announcements</h2>

<form method="POST" class="form-box">
    <label>Announcement Title :</label>
    <input type="text" name="title" placeholder="Title" required>

    <label>Message :</label>
    <textarea name="message" placeholder="Message" required></textarea>

    <center><button type="submit" class="btn">Post Announcement</button></center>
    </form>
</div>
<hr>
<br>
<h3>All Announcements</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Message</th>
        <th>Created At</th>
    </tr>
    <?php while ($row = $announcements->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['message']) ?></td>
        <td><?= date('d-m-Y h:i', strtotime($row['created_at'])) ?></td>
    </tr>
    <?php } ?>
</table>