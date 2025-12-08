<?php 
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	require_once ('process/dbh.php');
	 $sql1 = "SELECT * FROM `employee` where id = '$id'";
	 $result1 = mysqli_query($conn, $sql1);
	 $employeen = mysqli_fetch_array($result1);
	 $empName = ($employeen['firstName']);

	$sql = "SELECT id, firstName, lastName,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
	$sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id and status = 'Due'";

	$sql2 = "Select * From employee, employee_leave Where employee.id = $id and employee_leave.id = $id order by employee_leave.token";

	$sql3 = "SELECT * FROM `salary` WHERE id = $id";

//echo "$sql";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
?>



<html>
<head>
	<title>AI-Powered Employee Dashboard | EMS</title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
		}
		
		body::before {
			content: '';
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: 
				radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3), transparent 50%),
				radial-gradient(circle at 80% 80%, rgba(252, 70, 107, 0.3), transparent 50%);
			animation: gradientShift 15s ease infinite;
			z-index: -1;
		}
		
		@keyframes gradientShift {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.8; }
		}
		
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
			font-size: 1.8rem;
			font-weight: 700;
			color: white;
			text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
		}
		
		#navli {
			display: flex;
			list-style: none;
			gap: 0.5rem;
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
		}
		
		.homered {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
		}
		
		.welcome-banner {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			padding: 2rem;
			margin: 2rem 3rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
			display: flex;
			align-items: center;
			gap: 2rem;
		}
		
		.welcome-banner img {
			width: 100px;
			height: 100px;
			border-radius: 50%;
			border: 4px solid #667eea;
			animation: float 3s ease-in-out infinite;
		}
		
		@keyframes float {
			0%, 100% { transform: translateY(0px); }
			50% { transform: translateY(-10px); }
		}
		
		.welcome-text h2 {
			color: #333;
			font-size: 2rem;
			margin-bottom: 0.5rem;
		}
		
		.welcome-text p {
			color: #666;
			font-size: 1.1rem;
		}
		
		.quick-stats {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 1.5rem;
			padding: 0 3rem 2rem;
		}
		
		.stat-box {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 15px;
			padding: 1.5rem;
			text-align: center;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease;
		}
		
		.stat-box:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
		}
		
		.stat-box i {
			font-size: 2.5rem;
			margin-bottom: 1rem;
			display: block;
		}
		
		.stat-box h3 {
			font-size: 2rem;
			color: #333;
			margin-bottom: 0.5rem;
		}
		
		.stat-box p {
			color: #666;
			font-size: 0.9rem;
		}
		
		#divimg {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			padding: 2rem;
			margin: 0 3rem 2rem;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
		}
		
		#divimg h2 {
			color: #333;
			margin: 2rem 0 1.5rem;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 0.8rem;
		}
		
		table {
			width: 100%;
			border-collapse: separate;
			border-spacing: 0 0.5rem;
			margin-bottom: 2rem;
		}
		
		table tr {
			background: white;
			transition: all 0.3s ease;
		}
		
		table tr:hover {
			transform: scale(1.01);
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
			font-size: 0.85rem;
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
		
		.status-approved {
			background: #10b981;
			color: white;
			padding: 0.3rem 1rem;
			border-radius: 20px;
			font-size: 0.85rem;
		}
		
		.status-pending {
			background: #f59e0b;
			color: white;
			padding: 0.3rem 1rem;
			border-radius: 20px;
			font-size: 0.85rem;
		}
		
		.status-rejected {
			background: #ef4444;
			color: white;
			padding: 0.3rem 1rem;
			border-radius: 20px;
			font-size: 0.85rem;
		}
	</style>
</head>
<body>
	
	<header>
		<nav>
			<h1>🚀 EMS Employee Portal</h1>
			<ul id="navli">
				<li><a class="homered" href="eloginwel.php?id=<?php echo $id?>"><i class="fas fa-home"></i> HOME</a></li>
				<li><a class="homeblack" href="myprofile.php?id=<?php echo $id?>"><i class="fas fa-user"></i> My Profile</a></li>
				<li><a class="homeblack" href="empproject.php?id=<?php echo $id?>"><i class="fas fa-briefcase"></i> My Projects</a></li>
				<li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>"><i class="fas fa-calendar-plus"></i> Apply Leave</a></li>
				<li><a class="homeblack" href="elogin.html"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="welcome-banner">
		<img src="assets/avatar.png" alt="Profile">
		<div class="welcome-text">
			<h2>Welcome back, <?php echo $empName; ?>! 👋</h2>
			<p>Here's your personalized dashboard with AI-powered insights</p>
		</div>
	</div>
	
	<div class="quick-stats">
		<div class="stat-box">
			<i class="fas fa-tasks" style="color: #667eea;"></i>
			<h3><?php 
				$dueProj = mysqli_query($conn, "SELECT COUNT(*) as total FROM project WHERE eid = $id and status = 'Due'");
				$dueProjData = mysqli_fetch_assoc($dueProj);
				echo $dueProjData['total'];
			?></h3>
			<p>Due Projects</p>
		</div>
		
		<div class="stat-box">
			<i class="fas fa-check-circle" style="color: #10b981;"></i>
			<h3><?php 
				$compProj = mysqli_query($conn, "SELECT COUNT(*) as total FROM project WHERE eid = $id and status = 'Submitted'");
				$compProjData = mysqli_fetch_assoc($compProj);
				echo $compProjData['total'];
			?></h3>
			<p>Completed Projects</p>
		</div>
		
		<div class="stat-box">
			<i class="fas fa-trophy" style="color: #f59e0b;"></i>
			<h3><?php 
				$rankData = mysqli_query($conn, "SELECT points FROM rank WHERE eid = $id");
				$rankPoints = mysqli_fetch_assoc($rankData);
				echo $rankPoints['points'];
			?></h3>
			<p>Performance Points</p>
		</div>
		
		<div class="stat-box">
			<i class="fas fa-money-bill-wave" style="color: #10b981;"></i>
			<h3>₹<?php 
				$salData = mysqli_query($conn, "SELECT total FROM salary WHERE id = $id");
				$salTotal = mysqli_fetch_assoc($salData);
				echo number_format($salTotal['total']);
			?></h3>
			<p>Current Salary</p>
		</div>
	</div>
	
	<div id="divimg">
	<div>
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
   
    	<h2><i class="fas fa-clock"></i> Due Projects <i class="fas fa-exclamation-circle"></i></h2>
    	

    	<table>

			<tr>
				<th align = "center">Project Name</th>
				<th align = "center">Due Date</th>
				
			</tr>

			

			<?php
				while ($employee1 = mysqli_fetch_assoc($result1)) {
					echo "<tr>";
					
					echo "<td>".$employee1['pname']."</td>";
					
					echo "<td>".$employee1['duedate']."</td>";

				}


			?>

		</table>



		<h2><i class="fas fa-rupee-sign"></i> Salary Status <i class="fas fa-money-check-alt"></i></h2>
    	

    	<table>

			<tr>
				
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">Total Salary</th>
				
			</tr>

			

			<?php
				while ($employee = mysqli_fetch_assoc($result3)) {
					

					echo "<tr>";
					
					
					echo "<td>₹".number_format($employee['base'])."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>₹".number_format($employee['total'])."</td>";
					
				}


				


			?>

		</table>










		<h2><i class="fas fa-calendar-alt"></i> Leave Status <i class="fas fa-umbrella-beach"></i></h2>
    	

    	<table>

			<tr>
				
				<th align = "center">Start Date</th>
				<th align = "center">End Date</th>
				<th align = "center">Total Days</th>
				<th align = "center">Reason</th>
				<th align = "center">Status</th>
			</tr>

			

			<?php
				while ($employee = mysqli_fetch_assoc($result2)) {
					$date1 = new DateTime($employee['start']);
					$date2 = new DateTime($employee['end']);
					$interval = $date1->diff($date2);
					$interval = $date1->diff($date2);

					echo "<tr>";
					
					
					echo "<td>".$employee['start']."</td>";
					echo "<td>".$employee['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
					
				}


				


			?>

		</table>




   
<br>
<br>
<br>
<br>
<br>







	</div>


		</h2>


		
		
	</div>
</body>
</html>