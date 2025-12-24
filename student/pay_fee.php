<?php
ob_start(); // ✅ Added this line
//session_start();
include('../db.php');

if (!isset($_SESSION['student_id'])) {
    header('Location: ../student_login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: view_fees_student.php');
    exit();
}

$fee_id = $_GET['id'];
$room_no = $_SESSION['room_no'];

// Fetch the fee details (join fees + students for room_no)
$fee_result = mysqli_query($conn, "
    SELECT f.*, s.room_no 
    FROM fees f
    JOIN students s ON f.student_id = s.id
    WHERE f.id='$fee_id' AND s.room_no='$room_no'
") or die("Query Failed: " . mysqli_error($conn));

if (mysqli_num_rows($fee_result) == 0) {
    die("You are not authorized to pay this fee.");
}

$fee = mysqli_fetch_assoc($fee_result);

// Handle form submission
if (isset($_POST['pay'])) {
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    // Generate a unique transaction ID
    $txn_id = 'TXN' . time() . rand(100, 999);
    $payment_date = date('Y-m-d');

    // Update fee record
    $update_query = "
        UPDATE fees SET 
            status='Paid', 
            payment_method='$method',
            transaction_id='$txn_id',
            payment_date='$payment_date'
        WHERE id='$fee_id'
    ";
    mysqli_query($conn, $update_query) or die(mysqli_error($conn));

    header('Location: student_dashboard.php?page=view_fees_student&paid=1');
    exit();
}
?>
<div class="student">
    <h2 class="add" style=" margin-top: 30px; margin-bottom: -10px;"><i class="fa-solid fa-wallet"></i> Pay Fee</h2>

    <div class="profile-card">
        <div class="profile-info">
            <p><span>Room No &nbsp;:</span> <?= $fee['room_no'] ?></p>
            <p><span>Student Name &nbsp;:</span> <?= $_SESSION['student_name'] ?></p>
            <p><span>Amount &nbsp;:</span> <?= $fee['amount'] ?></p>
            <p><span>Months &nbsp;:</span> <?= $fee['months'] ?></p>
        </div>

        <form method="POST" class="form-box">
            <label>Select Payment Options :</label>
            <div class="payment-options" style="display: flex;
                                                gap: 20px;
                                                margin: 15px 0;
                                                justify-content: center;">
                <label>
                    <input type="radio" name="method" value="UPI" required onclick="togglePaymentFields()"> UPI
                </label>
                <label>
                    <input type="radio" name="method" value="Card" required onclick="togglePaymentFields()"> Card
                </label>
            </div>

            <!-- UPI Fields -->
            <div id="upiFields" style="display:none; margin-top:10px;">
                <label>UPI ID :</label>
                <input type="text" name="upi_id" placeholder="example@upi">
            </div><br>

            <!-- Card Fields -->
            <div id="cardFields" style="display:none; margin-top:10px;">
                <label>Card Number :</label>
                <input type="text" name="card_number" maxlength="16" placeholder="1234 5678 9012 3456">

                <label>Expiry Date :</label>
                <div class="date-picker">
                    <input type="month" name="expiry">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <label>CVV :</label>
                <input type="password" name="cvv" maxlength="3" placeholder="***">
            </div><br>

            <label>Enter Amount :</label>
            <input type="number" name="amount" value="<?= $fee['amount'] ?>" readonly>

            <input type="submit" name="pay" value="Pay Now">
        </form>
    </div>
    <a href="student_dashboard.php?page=view_fees_student" class="btn">Back to Fees</a>
</div>

<script>
function togglePaymentFields() {
    const method = document.querySelector('input[name="method"]:checked').value;
    document.getElementById('upiFields').style.display = (method === "UPI") ? "block" : "none";
    document.getElementById('cardFields').style.display = (method === "Card") ? "block" : "none";
}
</script>
<?php ob_end_flush(); // ✅ Added this line ?>
