<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

if (!isset($_GET['id'])) 
{
    header('Location: dashboard.php?page=view_fees');
    exit();
}

$fee_id = $_GET['id'];

// Fetch fee record to edit
$fee_result = mysqli_query($conn, "SELECT * FROM fees WHERE id='$fee_id'");
$fee = mysqli_fetch_assoc($fee_result);

// Fetch students for dropdown
$students = mysqli_query($conn, "SELECT id, name, room_no FROM students");

$error = "";

if (isset($_POST['submit'])) 
{
    $student_id = $_POST['student_name'];
    $months = (int)$_POST['months'];
    $base_rent = 6500;
    $amount = $months * $base_rent;
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    // Check for existing fee record (exclude current)
    $check_fee = mysqli_query($conn, "SELECT * FROM fees WHERE student_id='$student_id' AND id != '$fee_id'");
    
    if(mysqli_num_rows($check_fee) > 0) 
    {
        $error = "Error: Fee record for this student already exists!";
    } 
    else 
    {
        $sql = "UPDATE fees 
                SET student_id='$student_id', amount='$amount', months='$months', due_date='$due_date', status='$status' 
                WHERE id='$fee_id'";

        if (mysqli_query($conn, $sql)) 
        {
            echo "<script>alert('Fee record updated successfully'); window.location='dashboard.php?page=view_fees';</script>";
        } 
        else 
        {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<div class="add-student">
    <h2 class="add"><i class="fa-solid fa-pen"></i> Edit Fee Record</h2>
    
    <form method="post" class="form-box">
        <label>Student :</label> 
        <select name="student_name" required>
            <option value="">-- Select Student --</option>
            <?php 
            while ($row = mysqli_fetch_assoc($students)) { 
                $selected = ($row['id'] == $fee['student_id']) ? "selected" : "";
            ?>
                <option value="<?= $row['id'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($row['name']) ?> (Room <?= $row['room_no'] ?>)
                </option>
            <?php } ?>
        </select>

        <label>Months :</label>
        <input type="number" name="months" id="months" value="<?= $fee['months'] ?>" min="1" max="12" required>

        <label>Amount :</label>
        <input type="number" name="amount" id="amount" value="<?= $fee['amount'] ?>" readonly>

        <label>Status :</label>
        <select name="status">
            <option value="Unpaid" <?= $fee['status'] == 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
            <option value="Paid" <?= $fee['status'] == 'Paid' ? 'selected' : '' ?>>Paid</option>
        </select>

        <label>Due Date :</label>
        <div class="date-picker">
            <input type="date" name="due_date" value="<?= $fee['due_date'] ?>" required>
            <i class="fa-solid fa-calendar-days"></i>
        </div>

        <center><button type="submit" name="submit" class="btn">Update Fee</button></center>
    </form>
    <br>
    <?php if($error != "") { echo "<p style='color:red;'>$error</p>"; } ?>
</div>

<script>
const baseRent = 6500;
const monthsInput = document.getElementById("months");
const amountInput = document.getElementById("amount");

monthsInput.addEventListener("input", function() {
    const months = parseInt(monthsInput.value) || 0;
    const total = months * baseRent;
    amountInput.value = total > 0 ? total : '';
});
</script>
