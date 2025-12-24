<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

// Fetch students for dropdown
$students = mysqli_query($conn, "
    SELECT s.id, s.name, s.room_no
    FROM students s
");

$error = "";

if (isset($_POST['submit'])) 
{
    $student_id = $_POST['student_name']; 
    $months = (int)$_POST['months']; // admin input
    $base_rent = 6500;

    $amount = $months * $base_rent; // total amount
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];
    
    // Check if fee record already exists
    $check_fee = mysqli_query($conn, "SELECT * FROM fees WHERE student_id='$student_id'");
    
    if(mysqli_num_rows($check_fee) > 0) 
    {
        $error = "Error : ❌ Fee record for this student already exists!";
    }
    else 
    {
        $sql = "INSERT INTO fees (student_id, amount, months, due_date, status)
                VALUES ('$student_id','$amount','$months','$due_date','$status')";
            
        if (mysqli_query($conn, $sql)) 
        {
            echo "<script>alert('Fee record added successfully'); 
                window.location = 'dashboard.php?page=view_fees';</script>";
        } 
        else 
        {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<div class="add-student">
    <h2 class="add"><i class="fa-solid fa-wallet"></i> Add Fee Record</h2>    
    <form method="post" class="form-box">

    <label>Student :</label> 
    <select name="student_name" id="student_name" required>
    <option value="">-- Select Student --</option>
    <?php 
    while ($row = mysqli_fetch_assoc($students)) { ?>
        <option value="<?= $row['id'] ?>">
        <?= htmlspecialchars($row['name']) ?> (Room <?= $row['room_no'] ?>)
        </option>
    <?php } ?>
    </select>

    <label>Months :</label>
    <input type="number" name="months" id="months" min="1" max="12" required>

    <label>Amount : </label>
    <input type="number" name="amount" id="amount" readonly>
        
    <label>Status :</label>
    <select name="status">
        <option value="Unpaid">Unpaid</option>
        <option value="Paid">Paid</option>
    </select>

    <label>Due Date : </label>
    <div class="date-picker">
        <input type="date" name="due_date" required>
        <i class="fa-solid fa-calendar-days"></i>
    </div>

    <center><button type="submit" name="submit" class="btn">Add Fee</button></center>
    </form>
    <?php if($error != "") { echo "<p><br>$error</p>"; } ?>
</div>

<script>
const baseRent = 6500;
const monthsInput = document.getElementById('months');
const amountInput = document.getElementById('amount');

monthsInput.addEventListener('input', function() {
    const months = parseInt(monthsInput.value) || 0;
    const total = months * baseRent;
    amountInput.value = total > 0 ? total : '';
});
</script>