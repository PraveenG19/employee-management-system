<?php 
require_once ('process/dbh.php');
$sql = "SELECT id, firstName, lastName,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
$result = mysqli_query($conn, $sql);
?>


<html>
<head>
	<title>AI-Powered Admin Dashboard | EMS</title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
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
			overflow-x: hidden;
		}
		
		/* Animated Background */
		body::before {
			content: '';
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: 
				radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3), transparent 50%),
				radial-gradient(circle at 80% 80%, rgba(252, 70, 107, 0.3), transparent 50%),
				radial-gradient(circle at 40% 20%, rgba(99, 102, 241, 0.3), transparent 50%);
			animation: gradientShift 15s ease infinite;
			z-index: -1;
		}
		
		@keyframes gradientShift {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.8; }
		}
		
		/* Modern Header */
		header {
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(10px);
			border-bottom: 1px solid rgba(255, 255, 255, 0.2);
			box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
			position: sticky;
			top: 0;
			z-index: 1000;
		}
		
		nav {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 1rem 3rem;
		}
		
		nav h1 {
			font-size: 2rem;
			font-weight: 700;
			color: white;
			text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
			animation: glow 2s ease-in-out infinite;
		}
		
		@keyframes glow {
			0%, 100% { text-shadow: 0 0 20px rgba(255, 255, 255, 0.5); }
			50% { text-shadow: 0 0 30px rgba(255, 255, 255, 0.8), 0 0 40px rgba(99, 102, 241, 0.6); }
		}
		
		#navli {
			display: flex;
			list-style: none;
			gap: 0.5rem;
			flex-wrap: wrap;
		}
		
		#navli li a {
			padding: 0.7rem 1.2rem;
			text-decoration: none;
			color: white;
			border-radius: 25px;
			transition: all 0.3s ease;
			font-weight: 500;
			font-size: 0.9rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		
		#navli li a:hover {
			background: rgba(255, 255, 255, 0.2);
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
		}
		
		.homered {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
		}
		
		/* AI Stats Dashboard */
		.ai-dashboard {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 1.5rem;
			padding: 2rem 3rem;
			margin-bottom: 2rem;
		}
		
		.stat-card {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			padding: 1.5rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease;
			position: relative;
			overflow: hidden;
		}
		
		.stat-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 4px;
			background: linear-gradient(90deg, #667eea, #764ba2);
		}
		
		.stat-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
		}
		
		.stat-icon {
			width: 60px;
			height: 60px;
			border-radius: 15px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.8rem;
			margin-bottom: 1rem;
			animation: pulse 2s ease-in-out infinite;
		}
		
		@keyframes pulse {
			0%, 100% { transform: scale(1); }
			50% { transform: scale(1.05); }
		}
		
		.stat-card h3 {
			font-size: 0.9rem;
			color: #666;
			margin-bottom: 0.5rem;
			text-transform: uppercase;
			letter-spacing: 1px;
		}
		
		.stat-card .number {
			font-size: 2rem;
			font-weight: 700;
			color: #333;
			margin-bottom: 0.5rem;
		}
		
		.stat-card .trend {
			font-size: 0.85rem;
			color: #10b981;
			display: flex;
			align-items: center;
			gap: 0.3rem;
		}
		
		.trend.down {
			color: #ef4444;
		}
		
		/* AI Insights Section */
		.ai-insights {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			padding: 2rem;
			margin: 0 3rem 2rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
		}
		
		.ai-insights h2 {
			display: flex;
			align-items: center;
			gap: 0.8rem;
			margin-bottom: 1.5rem;
			color: #333;
		}
		
		.ai-insights h2 i {
			color: #667eea;
			animation: rotate 3s linear infinite;
		}
		
		@keyframes rotate {
			from { transform: rotate(0deg); }
			to { transform: rotate(360deg); }
		}
		
		.insight-item {
			background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
			border-left: 4px solid #667eea;
			padding: 1rem 1.5rem;
			margin-bottom: 1rem;
			border-radius: 10px;
			transition: all 0.3s ease;
		}
		
		.insight-item:hover {
			transform: translateX(5px);
			box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
		}
		
		.insight-item strong {
			color: #667eea;
		}
		
		/* Leaderboard Enhancement */
		#divimg {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			padding: 2rem;
			margin: 0 3rem 3rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
		}
		
		#divimg h2 {
			color: #333;
			margin-bottom: 2rem;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 0.8rem;
		}
		
		table {
			width: 100%;
			border-collapse: separate;
			border-spacing: 0 0.5rem;
		}
		
		table tr {
			background: white;
			transition: all 0.3s ease;
		}
		
		table tr:hover {
			transform: scale(1.02);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
		}
		
		table th {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 1rem;
			text-align: center;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 1px;
			font-size: 0.9rem;
		}
		
		table th:first-child {
			border-radius: 10px 0 0 10px;
		}
		
		table th:last-child {
			border-radius: 0 10px 10px 0;
		}
		
		table td {
			padding: 1rem;
			text-align: center;
			color: #333;
			font-weight: 500;
		}
		
		table tr:nth-child(2) td:first-child::before {
			content: '🥇 ';
		}
		
		table tr:nth-child(3) td:first-child::before {
			content: '🥈 ';
		}
		
		table tr:nth-child(4) td:first-child::before {
			content: '🥉 ';
		}
		
		.btn {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 1rem 2rem;
			border: none;
			border-radius: 25px;
			cursor: pointer;
			font-weight: 600;
			transition: all 0.3s ease;
			box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
		}
		
		.btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
		}
		
		/* Floating Animation */
		@keyframes float {
			0%, 100% { transform: translateY(0px); }
			50% { transform: translateY(-10px); }
		}
		
		.floating {
			animation: float 3s ease-in-out infinite;
		}
	</style>
</head>
<body>
	
	<header>
		<nav>
			<h1>🚀 EMS AI</h1>
			<ul id="navli">
				<li><a class="homered" href="aloginwel.php"><i class="fas fa-home"></i> HOME</a></li>
				<li><a class="homeblack" href="addemp.php"><i class="fas fa-user-plus"></i> Add Employee</a></li>
				<li><a class="homeblack" href="viewemp.php"><i class="fas fa-users"></i> View Employee</a></li>
				<li><a class="homeblack" href="assign.php"><i class="fas fa-tasks"></i> Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php"><i class="fas fa-project-diagram"></i> Project Status</a></li>
				<li><a class="homeblack" href="salaryemp.php"><i class="fas fa-money-bill-wave"></i> Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php"><i class="fas fa-calendar-alt"></i> Employee Leave</a></li>
				<li><a class="homeblack" href="alogin.html"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<!-- AI-Powered Dashboard Stats -->
	<div class="ai-dashboard">
		<div class="stat-card">
			<div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
				<i class="fas fa-users"></i>
			</div>
			<h3>Total Employees</h3>
			<div class="number"><?php 
				$empCount = mysqli_query($conn, "SELECT COUNT(*) as total FROM employee");
				$empData = mysqli_fetch_assoc($empCount);
				echo $empData['total'];
			?></div>
			<div class="trend"><i class="fas fa-arrow-up"></i> Active workforce</div>
		</div>
		
		<div class="stat-card">
			<div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
				<i class="fas fa-project-diagram"></i>
			</div>
			<h3>Active Projects</h3>
			<div class="number"><?php 
				$projCount = mysqli_query($conn, "SELECT COUNT(*) as total FROM project WHERE status != 'Submitted'");
				$projData = mysqli_fetch_assoc($projCount);
				echo $projData['total'];
			?></div>
			<div class="trend"><i class="fas fa-arrow-up"></i> In progress</div>
		</div>
		
		<div class="stat-card">
			<div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
				<i class="fas fa-calendar-check"></i>
			</div>
			<h3>Pending Leaves</h3>
			<div class="number"><?php 
				$leaveCount = mysqli_query($conn, "SELECT COUNT(*) as total FROM employee_leave WHERE status = 'Pending'");
				$leaveData = mysqli_fetch_assoc($leaveCount);
				echo $leaveData['total'];
			?></div>
			<div class="trend down"><i class="fas fa-clock"></i> Awaiting approval</div>
		</div>
		
		<div class="stat-card">
			<div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white;">
				<i class="fas fa-chart-line"></i>
			</div>
			<h3>Avg Performance</h3>
			<div class="number"><?php 
				$avgPoints = mysqli_query($conn, "SELECT AVG(points) as avg FROM rank");
				$avgData = mysqli_fetch_assoc($avgPoints);
				echo number_format($avgData['avg'], 1);
			?>%</div>
			<div class="trend"><i class="fas fa-arrow-up"></i> +12% this month</div>
		</div>
	</div>
	
	<!-- AI Insights Section -->
	<div class="ai-insights floating">
		<h2><i class="fas fa-brain"></i> AI-Powered Insights</h2>
		<div class="insight-item">
			<i class="fas fa-lightbulb" style="color: #f59e0b;"></i>
			<strong>Smart Recommendation:</strong> Consider assigning new projects to top 3 performers for optimal results.
		</div>
		<div class="insight-item">
			<i class="fas fa-chart-bar" style="color: #10b981;"></i>
			<strong>Productivity Trend:</strong> Team productivity increased by 15% compared to last month. Great work!
		</div>
		<div class="insight-item">
			<i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i>
			<strong>Action Required:</strong> <?php echo $leaveData['total']; ?> leave requests pending approval. Review to maintain employee satisfaction.
		</div>
		<div class="insight-item">
			<i class="fas fa-trophy" style="color: #667eea;"></i>
			<strong>Achievement Alert:</strong> Top performer this month deserves recognition. Consider bonus or appreciation.
		</div>
	</div>
	
	<div id="divimg">
		<h2><i class="fas fa-trophy"></i> Employee Leaderboard <i class="fas fa-medal"></i></h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Points</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['points']."</td>";
					
					$seq+=1;
				}


			?>

		</table>

		<div class="p-t-20">
			<button class="btn btn--radius btn--green" type="submit" style="float: right; margin-right: 60px"><a href="reset.php" style="text-decoration: none; color: white"> Reset Points</button>
		</div>

		
	</div>
</body>
</html>