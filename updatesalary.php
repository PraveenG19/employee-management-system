<?php 
require_once ('process/dbh.php');

// Get employee ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch employee details
$sql = "SELECT e.id, e.firstName, e.lastName, e.dept, s.base, s.bonus, s.total 
        FROM employee e 
        LEFT JOIN salary s ON e.id = s.id 
        WHERE e.id = '$id'";
$result = mysqli_query($conn, $sql);
$employee = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Salary | EMS</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
		
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			padding: 2rem;
		}
		
		.container {
			max-width: 800px;
			margin: 0 auto;
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			padding: 3rem;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
		}
		
		h1 {
			color: #333;
			margin-bottom: 0.5rem;
			display: flex;
			align-items: center;
			gap: 0.8rem;
		}
		
		h1 i {
			color: #667eea;
		}
		
		.subtitle {
			color: #666;
			margin-bottom: 2rem;
			padding-bottom: 1.5rem;
			border-bottom: 2px solid #e0e0e0;
		}
		
		.employee-info {
			background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
			padding: 1.5rem;
			border-radius: 15px;
			margin-bottom: 2rem;
		}
		
		.employee-info h3 {
			color: #333;
			margin-bottom: 1rem;
		}
		
		.info-grid {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 1rem;
		}
		
		.info-item {
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		
		.info-item i {
			color: #667eea;
			width: 20px;
		}
		
		.info-item strong {
			color: #333;
		}
		
		.form-section {
			margin-bottom: 2rem;
		}
		
		.form-section h3 {
			color: #333;
			margin-bottom: 1.5rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		
		.form-section h3 i {
			color: #667eea;
		}
		
		.form-group {
			margin-bottom: 1.5rem;
		}
		
		.form-group label {
			display: block;
			color: #333;
			font-weight: 600;
			margin-bottom: 0.5rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		
		.form-group label i {
			color: #667eea;
		}
		
		.input-wrapper {
			position: relative;
		}
		
		.input-wrapper input {
			width: 100%;
			padding: 1rem 1rem 1rem 3rem;
			border: 2px solid #e0e0e0;
			border-radius: 15px;
			font-size: 1rem;
			transition: all 0.3s ease;
			font-family: 'Poppins', sans-serif;
		}
		
		.input-wrapper input:focus {
			outline: none;
			border-color: #667eea;
			box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
		}
		
		.input-icon {
			position: absolute;
			left: 1rem;
			top: 50%;
			transform: translateY(-50%);
			color: #667eea;
			font-size: 1.1rem;
		}
		
		.input-suffix {
			position: absolute;
			right: 1rem;
			top: 50%;
			transform: translateY(-50%);
			color: #666;
			font-weight: 600;
		}
		
		.calculation-box {
			background: linear-gradient(135deg, #43e97b15 0%, #38f9d715 100%);
			border: 2px solid #43e97b;
			border-radius: 15px;
			padding: 1.5rem;
			margin-top: 2rem;
		}
		
		.calculation-box h4 {
			color: #333;
			margin-bottom: 1rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		
		.calculation-box h4 i {
			color: #43e97b;
		}
		
		.calc-row {
			display: flex;
			justify-content: space-between;
			padding: 0.8rem 0;
			border-bottom: 1px solid rgba(67, 233, 123, 0.2);
		}
		
		.calc-row:last-child {
			border-bottom: none;
			font-size: 1.3rem;
			font-weight: 700;
			color: #43e97b;
			padding-top: 1rem;
			margin-top: 0.5rem;
			border-top: 2px solid #43e97b;
		}
		
		.calc-label {
			color: #666;
		}
		
		.calc-value {
			color: #333;
			font-weight: 600;
		}
		
		.button-group {
			display: flex;
			gap: 1rem;
			margin-top: 2rem;
		}
		
		.btn {
			flex: 1;
			padding: 1rem 2rem;
			border: none;
			border-radius: 15px;
			font-size: 1.1rem;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 0.5rem;
			font-family: 'Poppins', sans-serif;
		}
		
		.btn-primary {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
		}
		
		.btn-primary:hover {
			transform: translateY(-3px);
			box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
		}
		
		.btn-secondary {
			background: #e0e0e0;
			color: #333;
		}
		
		.btn-secondary:hover {
			background: #d0d0d0;
			transform: translateY(-2px);
		}
		
		.increase-options {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 1rem;
			margin-bottom: 1.5rem;
		}
		
		.increase-btn {
			padding: 1rem;
			border: 2px solid #e0e0e0;
			border-radius: 15px;
			background: white;
			cursor: pointer;
			transition: all 0.3s ease;
			text-align: center;
		}
		
		.increase-btn:hover {
			border-color: #667eea;
			background: rgba(102, 126, 234, 0.05);
			transform: translateY(-2px);
		}
		
		.increase-btn.active {
			border-color: #667eea;
			background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
		}
		
		.increase-btn .percentage {
			font-size: 1.5rem;
			font-weight: 700;
			color: #667eea;
		}
		
		.increase-btn .label {
			font-size: 0.85rem;
			color: #666;
			margin-top: 0.3rem;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1><i class="fas fa-money-check-alt"></i> Update Employee Salary</h1>
		<p class="subtitle">Adjust salary and bonus for employee performance</p>
		
		<div class="employee-info">
			<h3><i class="fas fa-user"></i> Employee Information</h3>
			<div class="info-grid">
				<div class="info-item">
					<i class="fas fa-id-badge"></i>
					<span><strong>ID:</strong> <?php echo $employee['id']; ?></span>
				</div>
				<div class="info-item">
					<i class="fas fa-user"></i>
					<span><strong>Name:</strong> <?php echo $employee['firstName'] . ' ' . $employee['lastName']; ?></span>
				</div>
				<div class="info-item">
					<i class="fas fa-building"></i>
					<span><strong>Department:</strong> <?php echo $employee['dept']; ?></span>
				</div>
				<div class="info-item">
					<i class="fas fa-dollar-sign"></i>
					<span><strong>Current Salary:</strong> $<?php echo number_format($employee['total']); ?></span>
				</div>
			</div>
		</div>
		
		<form action="process/updatesalaryprocess.php" method="POST" id="salaryForm">
			<input type="hidden" name="employee_id" value="<?php echo $employee['id']; ?>">
			
			<div class="form-section">
				<h3><i class="fas fa-percentage"></i> Quick Increase Options</h3>
				<div class="increase-options">
					<div class="increase-btn" onclick="applyIncrease(5)">
						<div class="percentage">+5%</div>
						<div class="label">Standard</div>
					</div>
					<div class="increase-btn" onclick="applyIncrease(10)">
						<div class="percentage">+10%</div>
						<div class="label">Good Performance</div>
					</div>
					<div class="increase-btn" onclick="applyIncrease(15)">
						<div class="percentage">+15%</div>
						<div class="label">Excellent</div>
					</div>
					<div class="increase-btn" onclick="applyIncrease(20)">
						<div class="percentage">+20%</div>
						<div class="label">Outstanding</div>
					</div>
					<div class="increase-btn" onclick="applyIncrease(25)">
						<div class="percentage">+25%</div>
						<div class="label">Exceptional</div>
					</div>
					<div class="increase-btn" onclick="applyIncrease(30)">
						<div class="percentage">+30%</div>
						<div class="label">Promotion</div>
					</div>
				</div>
			</div>
			
			<div class="form-section">
				<h3><i class="fas fa-edit"></i> Manual Adjustment</h3>
				
				<div class="form-group">
					<label><i class="fas fa-dollar-sign"></i> Base Salary</label>
					<div class="input-wrapper">
						<i class="fas fa-dollar-sign input-icon"></i>
						<input type="number" name="base_salary" id="baseSalary" value="<?php echo $employee['base']; ?>" required oninput="calculateTotal()">
					</div>
				</div>
				
				<div class="form-group">
					<label><i class="fas fa-gift"></i> Bonus Percentage</label>
					<div class="input-wrapper">
						<i class="fas fa-percentage input-icon"></i>
						<input type="number" name="bonus" id="bonus" value="<?php echo $employee['bonus']; ?>" min="0" max="100" required oninput="calculateTotal()">
						<span class="input-suffix">%</span>
					</div>
				</div>
			</div>
			
			<div class="calculation-box">
				<h4><i class="fas fa-calculator"></i> Salary Calculation</h4>
				<div class="calc-row">
					<span class="calc-label">Base Salary:</span>
					<span class="calc-value" id="displayBase">$<?php echo number_format($employee['base']); ?></span>
				</div>
				<div class="calc-row">
					<span class="calc-label">Bonus (<span id="displayBonusPercent"><?php echo $employee['bonus']; ?></span>%):</span>
					<span class="calc-value" id="displayBonus">$<?php echo number_format($employee['base'] * $employee['bonus'] / 100); ?></span>
				</div>
				<div class="calc-row">
					<span class="calc-label">Total Salary:</span>
					<span class="calc-value" id="displayTotal">$<?php echo number_format($employee['total']); ?></span>
				</div>
			</div>
			
			<div class="button-group">
				<button type="button" class="btn btn-secondary" onclick="window.location.href='salaryemp.php'">
					<i class="fas fa-times"></i> Cancel
				</button>
				<button type="submit" class="btn btn-primary">
					<i class="fas fa-save"></i> Update Salary
				</button>
			</div>
		</form>
	</div>
	
	<script>
		const originalBase = <?php echo $employee['base']; ?>;
		
		function applyIncrease(percentage) {
			const newBase = Math.round(originalBase * (1 + percentage / 100));
			document.getElementById('baseSalary').value = newBase;
			
			// Highlight selected button
			document.querySelectorAll('.increase-btn').forEach(btn => {
				btn.classList.remove('active');
			});
			event.target.closest('.increase-btn').classList.add('active');
			
			calculateTotal();
		}
		
		function calculateTotal() {
			const base = parseFloat(document.getElementById('baseSalary').value) || 0;
			const bonusPercent = parseFloat(document.getElementById('bonus').value) || 0;
			const bonusAmount = base * bonusPercent / 100;
			const total = base + bonusAmount;
			
			// Update display
			document.getElementById('displayBase').textContent = '$' + base.toLocaleString();
			document.getElementById('displayBonusPercent').textContent = bonusPercent;
			document.getElementById('displayBonus').textContent = '$' + bonusAmount.toLocaleString();
			document.getElementById('displayTotal').textContent = '$' + total.toLocaleString();
		}
		
		// Initialize calculation
		calculateTotal();
	</script>
</body>
</html>
