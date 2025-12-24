<?php
include('../db.php');

if (!isset($_SESSION['admin'])) {
    header('Location: ../index.php');
    exit();
}

$msg = "";

// --- Configuration ---
$total_floors = 2;
$total_rooms = 10;
$capacity_per_room = 3;

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $floor_no = isset($_POST['floor_no']) ? (int)$_POST['floor_no'] : 0;
    $room_no = isset($_POST['room_no']) ? (int)$_POST['room_no'] : 0;

    // --- Validation ---
    if ($floor_no < 1 || $floor_no > $total_floors) 
    {
        $msg = "❌ Invalid floor number!";
    } 
    elseif ($room_no < 1 || $room_no > $total_rooms) 
    {
        $msg = "❌ Invalid room number! Must be between 1 and $total_rooms.";
    } 
    elseif (
        ($floor_no == 1 && ($room_no < 1 || $room_no > 5)) ||
        ($floor_no == 2 && ($room_no < 6 || $room_no > 10))
    ) 
    {
        $msg = "❌ Room number does not match the selected floor!";
    } 
    else 
    {
        // ✅ Check total room count
        $countRes = $conn->query("SELECT COUNT(*) AS total FROM rooms");
        $count = $countRes->fetch_assoc();

        if ($count['total'] >= $total_rooms) 
        {
            $msg = "❌ Cannot add more rooms. Only $total_rooms allowed.";
        } 
        else 
        {
            // ✅ Check if room already exists
            $check = $conn->query("SELECT * FROM rooms WHERE room_no='$room_no'");
            if ($check && $check->num_rows > 0) 
            {
                $msg = "❌ Room already exists!";
            } 
            else 
            {
                // ✅ Insert room
                $sql = "INSERT INTO rooms (room_no, floor_no, status) 
                        VALUES ('$room_no', '$floor_no', 'Available')";
                if ($conn->query($sql)) {
                    $msg = "✅ Room added successfully! (Floor $floor_no, Room $room_no)";
                } 
                else 
                {
                    $msg = "❌ Error : " . $conn->error;
                }
            }
        }
    }
}

// --- Fetch all rooms ---
$query = "SELECT 
            r.room_no, 
            r.floor_no, 
            r.status,
            (SELECT COUNT(*) FROM students s WHERE s.room_no = r.room_no) AS total_students
          FROM rooms r
          ORDER BY r.room_no ASC";

$rooms = $conn->query($query);

// Prevent fatal error
if (!$rooms) 
{
    die('❌ Database Query Failed: ' . $conn->error);
}

?>

<style>

.room-management .form-box input[type="number"] 
{
    width: 450px;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.05);
    color: #fff;
    margin-top: 15px;
    margin-bottom: 10px;
    transition: 0.3s;
}

.msg 
{
    margin-top: 15px;
    font-weight: bold;
}

.status.available { color: #4caf50; }
.status.occupied { color: #f44336; }

</style>

<div class="room-management">
    <h2 class="add"><i class="fa-solid fa-bed"></i> Room Management</h2>

    <form method="POST" class="form-box">
        <label>Floor No :</label>
        <input type="number" name="floor_no" min="1" max="<?= $total_floors ?>" required>

        <label>Room No :</label>
        <input type="number" name="room_no" min="1" max="<?= $total_rooms ?>" required>

        <input type="submit" value="Add Room">
    </form>

    <?php if ($msg) echo "<p class='msg'>$msg</p>"; ?>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Floor No</th>
            <th>Room No</th>
            <th>Status</th>
            <th>Total Students</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $rooms->fetch_assoc()) 
        { 
            $total = isset($row['total_students']) ? (int)$row['total_students'] : 0;
            $remaining = max(0, $capacity_per_room - $total);
        ?>
        <tr>
            <td><?= htmlspecialchars($row['floor_no']) ?></td>
            <td><?= htmlspecialchars($row['room_no']) ?></td>
            <td>
                <?php
                if ($total >= $capacity_per_room) 
                {
                    echo "<span class='status occupied'>❌ Occupied ($capacity_per_room/$capacity_per_room)</span>";
                } 
                else 
                {
                    echo "<span class='status available'>✅ Available ($remaining seats left)</span>";
                }
                ?>
            </td>
            <td><?= $total ?></td>
            <td><?= $capacity_per_room ?></td>
            <td>
                <a href="dashboard.php?page=delete_room&room_no=<?= urlencode($row['room_no']) ?>" 
                   class="btn" 
                   onclick="return confirm('Are you sure you want to delete this room?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>