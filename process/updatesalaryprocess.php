<?php
require_once 'dbh.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $base_salary = $_POST['base_salary'];
    $bonus = $_POST['bonus'];
    
    // Calculate total
    $total = $base_salary + ($base_salary * $bonus / 100);
    
    // Update salary table
    $sql = "UPDATE salary SET base = '$base_salary', bonus = '$bonus', total = '$total' WHERE id = '$employee_id'";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: ../salaryemp.php?success=updated");
    } else {
        header("Location: ../updatesalary.php?id=$employee_id&error=failed");
    }
} else {
    header("Location: ../salaryemp.php");
}
?>
