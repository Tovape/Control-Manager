<!DOCTYPE HTML>
<html lang="es-ES">
	<link rel="icon" href="svg/logo.svg" type="image/gif" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="./css/global.css">
	<link rel="stylesheet" type="text/css" href="./css/elements.css">
	<link rel="stylesheet" type="text/css" href="./css/media.css">
	<link rel="stylesheet" type="text/css" href="./css/darktheme.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
<head>
	<title>Tovape - Control Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8"/>
	<script src="https://kit.fontawesome.com/6308dbf55d.js" crossorigin="anonymous"></script>
	<script src="https://cdn.websitepolicies.io/lib/cookieconsent/1.0.3/cookieconsent.min.js" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/quicklink/2.2.0/quicklink.umd.js"></script>
	<script type="text/javascript" src="javascript.js"></script>
	<script>
	
	// Windows Size
	
	function getSize(){
		document.getElementById('inp_width').value=screen.width;
		document.getElementById('inp_height').value=screen.height;
		document.getElementById('form_size').submit();
	}
	
	</script>
	
</head>

<?php

	// Connection

	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "control";
	
	$conn = mysqli_connect($server, $username, $password, $dbname);

	$sql = "SELECT * FROM config;";
	$result = mysqli_query($conn, $sql);
	$resultcheck = mysqli_num_rows($result);

	if ($resultcheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['theme'] == 0) {
				echo "<body onload='browserScreen()' class='light-theme'>";
				$darkmode = 0;
			} else if ($row['theme'] == 1) {
				echo "<body onload='browserScreen()' class='dark-theme'>";
				$darkmode = 1;
			}
		}
	}

	// Include Files

	include 'functions.php';
	include './tasks/tasks.php';
	include './timer/timer.php';
	include './weather/weather.php';
	
	// Check Files
	
	$percentagecount1 = 30;

	$javascriptjs = './javascript.js';
	$stylecss = './css/global.css';
	$functionsphp = './functions.php';
	$tasksphp = './tasks/tasks.php';
	$timerphp = './timer/timer.php';
	$batcheck = './bat/cpuId.bat';
	$imgcheck = './img/config/add.png';

	if (file_exists($javascriptjs)) {
		$percentagecount1 += 10;
	}
	
	if (file_exists($stylecss)) {
		$percentagecount1 += 10;
	}
	
	if (file_exists($functionsphp)) {
		$percentagecount1 += 10;
	}
	
	if (file_exists($tasksphp)) {
		$percentagecount1 += 10;
	}
	
	if (file_exists($timerphp)) {
		$percentagecount1 += 10;
	}
	
	if (file_exists($batcheck)) {
		$percentagecount1 += 10;
	}
	
	if (file_exists($imgcheck)) {
		$percentagecount1 += 10;
	}

	// Sorting Tasks Function

	if (isset($_POST["sortButton"])) {
		
		if (isset($_POST["sortime"])) {
			$sortime = $_POST["sortime"];
		} else {
			$sortime = null;
		}
		
		if (isset($_POST["sortstatus"])) {
			$sortstatus = $_POST["sortstatus"];
		} else {
			$sortstatus = null;
		}
		
	} else {
		$sortime = null;
		$sortstatus = null;
	}
	
	// Task Creator
	
	$tasks = new Tasks();
	$tasks_each = $tasks->getTasks($sortime, $sortstatus);

	$subtasks = new Subtasks();
	$subtasks_each = $subtasks->getSubtasks();

	// Count Tasks
	
	$taskcount = 0;
	
	foreach ($tasks_each as $task) {
		$taskcount++;
	}
	
	// Timer Creator
	
	$timer = new Timer();
	$timer_each = $timer->getTimer();
	
?>

<form method='post' id='form_size'>
	<input type='hidden' name='width' id='inp_width'/>
	<input type='hidden' name='height' id='inp_height'/>
</form>

<div class="sidebar sidebar-open" id="sidebar">
	<div class="sidebar-logo">
		<button onclick="sidebaraction()" id="sidebarbutton">
			<i class="fas fa-bars"></i>
		</button>
		<span class="sidebar-logo-text">Control Panel</span>
	</div>
	
	<ul class="nav-link">
		<li class="nav-link-each status" id="status-selector">
			<div class="nav-link-each-border selector" data-filter="status">
				<i class="fas fa-signal"></i>
				<span class="nav-link-text">Status</span>
				<span class="nav-link-hover">Status</span>
			</div>
		</li>
		<li class="nav-link-each projects" id="projects-selector">
			<div class="nav-link-each-border selector" data-filter="projects">
				<i class="fas fa-project-diagram"></i>
				<span class="nav-link-text">Projects</span>
				<span class="nav-link-hover">Projects</span>
			</div>
		</li>
		<li class="nav-link-each timer" id="timer-selector">
			<div class="nav-link-each-border selector" data-filter="timer">
				<i class="fas fa-clock"></i>
				<span class="nav-link-text">Timer</span>
				<span class="nav-link-hover">Timer</span>
			</div>
		</li>
		<li class="nav-link-each weather" id="timer-selector">
			<div class="nav-link-each-border selector" data-filter="weather">
				<i class="fas fa-cloud-sun"></i>
				<span class="nav-link-text">Weather</span>
				<span class="nav-link-hover">Weather</span>
			</div>
		</li>
		<li class="nav-link-each tasks" id="tasks-selector">
			<div class="nav-link-each-border selector" data-filter="tasks">
				<i class="fas fa-tasks"></i>
				<span class="nav-link-text">Tasks</span>
				<span class="nav-link-hover">Tasks</span>
			</div>
		</li>
	</ul>
	
	<div class="sidebar-wrapper">
		<div class="sidebar-setting">
			<div class="sidebar-border selector" id="setting-selector" data-filter="setting">
				<i class="fas fa-sliders-h"></i>
				<span class="sidebar-setting-text">Settings</span>
			</div>
		</div>
	</div>
</div>

<div id="content-wrapper" class="content-wrapper content-close">
	<div class="content">
	
	<div class="section-time">
		<span id="getTime"></span>
		<span id="getDay"></span>
		<span id="getDate"></span>
	</div>
	
	<div class="itemBox status" id="status">
		<div class="section">
			<p>Status</p>
		</div>

		<div class="status-progress-flex">
			<div class="status-progress-flex-each">	
				<div class="progress">
					<div role="progressbar" aria-valuenow="<?php echo $percentagecount1; ?>" aria-valuemin="0" aria-valuemax="<?php echo $percentagecount1; ?>" style="--value: <?php echo $percentagecount1; ?>"></div>
				</div>
				<p class="status-progress-flex-each-title">System Status</p>
				<p class="status-progress-flex-each-desc">Filesystem</p>
			</div>
			<div class="status-progress-flex-each">
				<div class="progress progress-animation-2">
					<div role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45" style="--value: 45"></div>
				</div>
				<p class="status-progress-flex-each-title">Projects</p>
				<p class="status-progress-flex-each-desc">Progress</p>
			</div>
			<div class="status-progress-flex-each">
				<div class="progress progress-animation-3">
					<div role="progressbar" aria-valuenow="<?php echo $$taskcount*10; ?>" aria-valuemin="0" aria-valuemax="<?php echo $taskcount*10; ?>" style="--value: <?php echo $taskcount*10; ?>"></div>
				</div>
				<p class="status-progress-flex-each-title">Tasks</p>
				<p class="status-progress-flex-each-desc">Remaining</p>
			</div>
		</div>
		
		<div class="subsection">
			<h2>System Properties</h2>
		</div>
		
		<div class="system-spec">
		
			<div class="system-table">
				<table>
					<tr>
						<th colspan="2">System Information</th>
					</tr>
					<tr>
						<td>Operative System</td>
						<td>
							<?php
								echo sysOSFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Hostname</td>
						<td>
							<?php
								echo sysHostnameFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>System Language</td>
						<td>
							<?php
								echo sysLanguageFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Timezone</td>
						<td>
						
						<?php
							echo date_default_timezone_get();
						?>
						
						</td>
					</tr>
					<tr>
						<th colspan="2">Browser Information</th>
					</tr>
					<tr>
						<td>Browser</td>
						<td><span id="getBrowser"></span></td>
					</tr>
					<tr>
						<td>Preference Language</td>
						<td>
							<?php
								echo sysBLFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Screen Resolution</td>
						<td><span id="screenwidth"></span> x <span id="screenheight"></span></td>
					</tr>
					<tr>
						<td>Browser Resolution</td>
						<td><span id="innerWidth"></span> x <span id="innerHeight"></span></td>
					</tr>
					<tr>
						<td>Color Depth</td>
						<td><span id="screencolorDepth"></span></td>
					</tr>
			
				</table>
			</div>
			
			<div class="system-table">
				<table>
					<tr>
						<th colspan="2">Hardware</th>
					</tr>
					<tr>
						<td>Manufacturer</td>
						<td>
							<?php
								echo sysManufacturerFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Product</td>
						<td>
							<?php
								echo sysProductFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>BIOS</td>
						<td>
							<?php
								echo sysBiosFunction();
							?>
						</td>
					</tr>
					<tr>
						<th colspan="2">CPU</th>
					</tr>
					<tr>
						<td>Model</td>
						<td>
							<?php
								echo sysCpunameFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Architecture</td>
						<td>
							<?php
								echo sysCpuarchitectureFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Cores</td>
						<td>
							<?php
								echo sysCpucoresFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Max Clock Speed</td>
						<td>
							<?php
								echo sysMCSFunction();
							?>
						</td>						
					</tr>
					<tr>
						<td>Caption</td>
						<td>
							<?php
								echo sysCpucaptionFunction();
							?>
						</td>	
					</tr>
					<tr>
						<th colspan="2">RAM</th>
					</tr>
					<tr>
						<td>Channels</td>
						<td>
							<?php
								echo sysRamslotFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>DDR Type</td>
						<td>
							<?php
								echo sysRamddrtypeFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Factor Type</td>
						<td>
							<?php
								echo sysRamfactortypeFunction();
							?>
						</td>
					</tr>
					<tr>
						<td>Total Capacity</td>
						<td>
							<?php
								echo sysRamSizeFunction();
							?>
						</td>
					</tr>
				</table>
			</div>
			
		</div>
			
		<div class="subsection">
			<h2>Media Properties</h2>
		</div>
		
		<div class="system-spec">
				
			<?php
				sysMediaFunction();
			?>

		</div>
	</div>
	
	<div class="itemBox projects" id="projects">
		<div class="section">
			<p>Projects</p>
		</div>
	</div>
	
	<div class="itemBox timer" id="timer">
		<div class="section">
			<p>Timer</p>
		</div>
		
		<div class="tasks-add timer-background">
			<form action="./timer/addtimer.php" method="post">
				<div class="tasks-add-banner">
					<img src='./img/config/add.png'/>
					<input type="text" id="timertitle" name="timertitle" placeholder="Title" required>
					<input type="text" id="timerlink" name="timerlink" placeholder="Link">
				</div>
				
				<textarea id="timerdesc" name="timerdesc" rows="4" cols="50" placeholder="Description"></textarea>
				
				<select id="timertype" name="timertype">
					<option value=0>Ocasional</option>
					<option value=1>Rutinary</option>
				</select>
				
				<input type="month" id="timerOcasional" name="timerOcasional">
								
				<select id="timerRutinary" name="timerRutinary">
					<option value=0>Weekly</option>
					<option value=1>Every 1 Month</option>
					<option value=2>Every 2 Month</option>
					<option value=3>Every 4 Month</option>
					<option value=4>Every 8 Month</option>
					<option value=5>Yearly</option>
				</select>
				
				<input type="submit" name="submit" value="Add">
			</form>
		</div>
		
		
		<div class="tasks-flex">
	
			<?php 
			
			foreach ($timer_each as $timer): ?>
			
			<div class="tasks-each">
				<div class="tasks-each-banner">
				
					<div class="tasks-each-banner-sub">
						<img src="img/timer/clock.png">
						<p class="tasks-each-title"><?php echo $timer['title'];

						if ($timer['rutine'] != 0) {
								echo " | ".getFrequency($timer['rutine']);
							} else if (!is_null($timer['date'])) {
								echo " | For ".date('d-m-Y', strtotime($timer['date']));
							}
						
						?>
						
						</p>
					</div>
					
					<p class="tasks-each-timestamp">Created the <?php echo date('d-m-Y', strtotime($timer['timestamp'])) ?></p>
				</div>
				
				<div class="tasks-each-content-timer">
						
					<p class="tasks-each-description"><?php echo $timer['description']?></p>
					<a class="tasks-each-link" target='_blank' href='<?php echo $timer['link']?>'>Link</a>
				
					<?php
					
					echo "<p class='timer-each-remain'>";
						
						if ($timer['rutine'] != 0) {
							
							if ($timer['rutine'] == 0) {
								
								$date_next = new DateTime($timer['timestamp']);
								$date_next->modify('+1 week');
								
								echo "Next Timestop the ".$date_next->format("d")." of ";
								echo $date_next->format("F")." in ";
								echo $date_next->format("Y");
								echo "</p>";
				
							}
							
							if ($timer['rutine'] == 1) {
								
								$date_next = new DateTime($timer['timestamp']);
								$date_next->modify('+1 month');
								
								echo "Next Timestop the ".$date_next->format("d")." of ";
								echo $date_next->format("F")." in ";
								echo $date_next->format("Y");
								echo "</p>";
				
							}
							
							if ($timer['rutine'] == 2) {
								
								$date_next = new DateTime($timer['timestamp']);
								$date_next->modify('+2 month');
								
								echo "Next Timestop the ".$date_next->format("d")." of ";
								echo $date_next->format("F")." in ";
								echo $date_next->format("Y");
								echo "</p>";
				
							}
							
							if ($timer['rutine'] == 3) {
								
								$date_next = new DateTime($timer['timestamp']);
								$date_next->modify('+4 month');
								
								echo "Next Timestop the ".$date_next->format("d")." of ";
								echo $date_next->format("F")." in ";
								echo $date_next->format("Y");
								echo "</p>";
				
							}
							
							if ($timer['rutine'] == 4) {
								
								$date_next = new DateTime($timer['timestamp']);
								$date_next->modify('+8 month');
								
								echo "Next Timestop the ".$date_next->format("d")." of ";
								echo $date_next->format("F")." in ";
								echo $date_next->format("Y");
								echo "</p>";
				
							}
							
							if ($timer['rutine'] == 5) {
								
								$date_next = new DateTime($timer['timestamp']);
								$date_next->modify('+12 month');
								
								echo "Next Timestop the ".$date_next->format("d")." of ";
								echo $date_next->format("F")." in ";
								echo $date_next->format("Y");
								echo "</p>";
				
							}
							
						} else if (!is_null($timer['date'])) {

							$date_expire = new DateTime($timer['date']);
							$date_now = new DateTime($timer['timestamp']);
							$dateCheck = 0;
							
							if ($date_expire->diff($date_now)->format("%d") < "01") {
								echo $date_expire->diff($date_now)->format("%d")." days, ";
								$dateCheck++;
							}
							
							if ($date_expire->diff($date_now)->format("%m") != "00") {
								echo $date_expire->diff($date_now)->format("%m")." months";
								$dateCheck++;
							}
							
							if ($date_expire->diff($date_now)->format("%Y") != "00") {
								echo $date_expire->diff($date_now)->format("%Y")." years";
								$dateCheck++;
							}
							
							if ($dateCheck == 0) {
								echo "Time Exceeded!</p>";
							} else {
								echo " Remaining</p>";
							}
							
						}
					?>
					
					<div class="tasks-delete">
						<form action="./timer/deletetimer.php" method="post">
							<input class="tasks-delete-value" type="radio" name="timerid" checked value=<?php echo $timer['id']?>>
							<input type="submit" name="submit" value="">
						</form>
					</div>
					
				</div>
				
			</div>
			
			<?php endforeach; ?>
			
		</div>
		
		
	</div>
	
	<div class="itemBox weather" id="weather">
		<div class="section">
			<p>Weather</p>
		</div>
		
		<div class="weather-flex">
		
			<?php
			
			weather();
			
			?>
		
		</div>

	</div>
	
	<div class="itemBox tasks" id="tasks">
		<div class="section">
			<p>Tasks</p>
		</div>
	
		<div class="tasks-add tasks-background">
		
			<form action="./tasks/addtask.php" method="post">
				<div class="tasks-add-banner">
					<img src='./img/config/add.png'/>
					<input type="text" id="tasktitle" name="tasktitle" placeholder="Title" required>
					<input type="text" id="tasksubtitle" name="tasksubtitle" placeholder="Subtitle">
				</div>
				
				<textarea id="taskdesc" name="taskdesc" rows="4" cols="50" placeholder="Description"></textarea>

				<select id="taskstatus" name="taskstatus">
					<option value=4>Unknown</option>
					<option value=0>In Progress</option>
					<option value=1>Finished</option>
					<option value=2>Priority</option>
					<option value=3>Cancelled</option>
				</select>

				<input type="submit" name="submit" value="Add">
			</form>
			
		</div>
		
		<div class="tasks-sort">
			<i class="fas fa-filter"></i>
						
			<div class="tasks-sort-radio1">
			<p class="tasks-sort-radio-title">Status</p>
			
			<form action="" method="post">
			
				<label>
					<input type="radio" name="sortstatus" value=5>
					<?php if($sortstatus == 5) {
						echo "<img class='tasks-sort-checked-round' src='./img/config/status-5.png'/>";
					} else {
						echo "<img src='./img/config/status-5.png'/>";
					}
					?>
				</label>
			
				<label>
					<input type="radio" name="sortstatus" value=4>
					<?php if($sortstatus == 4) {
						echo "<img class='tasks-sort-checked-round' src='./img/config/status-4.png'/>";
					} else {
						echo "<img src='./img/config/status-4.png'/>";
					}
					?>
				</label>
				
				<label>
					<input type="radio" name="sortstatus" value=0>
					<?php if($sortstatus == 0) {
						echo "<img class='tasks-sort-checked-round' src='./img/config/status-0.png'/>";
					} else {
						echo "<img src='./img/config/status-0.png'/>";
					}
					?>
				</label>
				
				<label>
					<input type="radio" name="sortstatus" value=1>
					<?php if($sortstatus == 1) {
						echo "<img class='tasks-sort-checked-round' src='./img/config/status-1.png'/>";
					} else {
						echo "<img src='./img/config/status-1.png'/>";
					}
					?>
				</label>
				
				<label>
					<input type="radio" name="sortstatus" value=2>
					<?php if($sortstatus == 2) {
						echo "<img class='tasks-sort-checked-round' src='./img/config/status-2.png'/>";
					} else {
						echo "<img src='./img/config/status-2.png'/>";
					}
					?>
				</label>
				
				<label>
					<input type="radio" name="sortstatus" value=3>
					<?php if($sortstatus == 3) {
						echo "<img class='tasks-sort-checked-round' src='./img/config/status-3.png'/>";
					} else {
						echo "<img src='./img/config/status-3.png'/>";
					}
					?>
				</label>
			
			</div>
			
			<div class="tasks-sort-radio2">
			
				<p class="tasks-sort-radio-title">Sort By</p>
				
				<label>
					<input type="radio" name="sortime" value=1>
					
					<?php if($sortime == 1) {
						echo "<p class='tasks-sort-checked-square'>Recent</p>";
					} else {
						echo "<p>Recent</p>";
					}
					?>
					
				</label>
				
				<label>
					<input type="radio" name="sortime" value=0>
					
					<?php if($sortime == 0) {
						echo "<p class='tasks-sort-checked-square'>Oldest</p>";
					} else {
						echo "<p>Oldest</p>";
					}
					?>
					
				</label>

				<input type="submit" name="sortButton" value="Filter">

			</div>
				
			</form>
				
		</div>
	
		<div class="tasks-flex">
	
			<?php 
			
			foreach ($tasks_each as $task): ?>
			
			<div class="tasks-each">
				<div class="tasks-each-banner">
				
					<div class="tasks-each-banner-sub">
						<?php
						
						if ($task['status'] == 0) {
							echo "<img src='./img/config/status-0.png'/>";
						} else if ($task['status'] == 1) {
							echo "<img src='./img/config/status-1.png'/>";
						} else if ($task['status'] == 2) {
							echo "<img src='./img/config/status-2.png'/>";
						} else if ($task['status'] == 3) {
							echo "<img src='./img/config/status-3.png'/>";
						} else if ($task['status'] == 4) {
							echo "<img src='./img/config/status-4.png'/>";
						}
						
						?>
	
						<p class="tasks-each-title"><?php echo $task['title']?></p>
					</div>
					
					<p class="tasks-each-timestamp">Created the <?php echo date('d-m-Y', strtotime($task['timestamp'])) ?></p>
				</div>
				
				<div class="tasks-each-content">
					
					<!--<img class="tasks-each-image" src="img/tasks/<?php echo $task['image']?>"/>-->
					<p class="tasks-each-subtitle"><?php echo $task['subtitle']?></p>
					<p class="tasks-each-description"><?php echo $task['description']?></p>
		
					<div class="subtasks-flex">
						
						<?php 
						
						foreach ($subtasks_each as $subtask): ?>
						
						<?php
						
						if ($task['id'] == $subtask['relation']) {

							echo "<div class='subtasks-each'>";
								echo "<div class='subtasks-each-banner'>";
						
									if ($subtask['status'] == 0) {
										echo "<img src='./img/config/status-0.png'/>";
									} else if ($subtask['status'] == 1) {
										echo "<img src='./img/config/status-1.png'/>";
									} else if ($subtask['status'] == 2) {
										echo "<img src='./img/config/status-2.png'/>";
									} else if ($subtask['status'] == 3) {
										echo "<img src='./img/config/status-3.png'/>";
									} else if ($subtask['status'] == 4) {
										echo "<img src='./img/config/status-4.png'/>";
									}
				
									echo "<p class='subtasks-each-title'>".$subtask['title']."</p>";
								echo "</div>";
								
								echo "<div class='subtasks-each-content'>";
								
									if ($subtask['subtitle'] == !0) {
										echo "<p class='subtasks-each-subtitle'>".$subtask['subtitle']."</p>";
									}
								
									if ($subtask['link'] == !0) {
										echo "<a class='subtasks-each-link' target='_blank' href='".$subtask['link']."'>Link</a>";
									}

									//echo "<img class='subtasks-each-image' src='img/tasks/".$subtask['image']."'/>";
									
									echo "<div class='subtasks-edit'>";
										echo "<form action='./tasks/editsubtask.php' method='post'>";
										echo "<input class='subtasks-edit-value' type='radio' name='subtaskid' checked value=".$subtask['id'].">";
										echo "<input type='submit' name='submit' value=''>";
										echo "</form>";
									echo "</div>";
									
									echo "<div class='subtasks-delete'>";
										echo "<form action='./tasks/deletesubtask.php' method='post'>";
										echo "<input class='subtasks-delete-value' type='radio' name='subtaskid' checked value=".$subtask['id'].">";
										echo "<input type='submit' name='submit' value=''>";
										echo "</form>";
									echo "</div>";
								
								echo "</div>";
										
							echo "</div>";
						}
						
						?>					
						
						<?php endforeach; ?>
						
						<div class='subtasks-add'>
							<form action="./tasks/addsubtask.php" method="post">
								<input type="text" id="subtasktitle" name="subtasktitle" placeholder="Title" required>
								<input type="text" id="subtasksubtitle" name="subtasksubtitle" placeholder="Subtitle">
								<input type="text" id="subtasklink" name="subtasklink" placeholder="Link">
								
								<select id="subtaskstatus" name="subtaskstatus">
									<option value=4>Unknown</option>
									<option value=0>In Progress</option>
									<option value=1>Finished</option>
									<option value=2>Priority</option>
									<option value=3>Cancelled</option>
								</select>
								<input class="tasks-edit-value" type="radio" name="subtaskid" checked value=<?php echo $task['id']?>>
								<input type="submit" name="submit" value="Add">
							</form>
						</div>
						
						<div class="tasks-edit">
							<form action="./tasks/editask.php" method="post">
								<input class="tasks-edit-value" type="radio" name="taskid" checked value=<?php echo $task['id']?>>
								<input type="submit" name="submit" value="">
							</form>
						</div>
						
						<div class="tasks-delete">
							<form action="./tasks/deletetask.php" method="post">
								<input class="tasks-delete-value" type="radio" name="taskid" checked value=<?php echo $task['id']?>>
								<input type="submit" name="submit" value="">
							</form>
						</div>
					</div>
		
				</div>
				
			</div>
			
			<?php endforeach; ?>
			
		</div>
		
	</div>
	
	<div class="itemBox setting" id="setting">
		<div class="section">
			<p>Settings</p>
		</div>
		
		<div class="setting-flex">
		
			<div class="setting-each">
				<h2>Dark Mode</h2>
				<form action="./setting/theme.php" method="post" class="setting-form">
					<label class="pure-material-switch">
						<input type="checkbox" name="themeoption" <?php if($darkmode == 1) {echo "checked";} ?>>
						<span></span>
					</label>
					<label class="pure-material-apply">
						<input type="submit">
						<span>Apply</span>
					</label>
				</form>
			</div>
		
		</div>
	</div>

	</div>

</div>

</div>

<div id="loading"></div>

<script>

// Loading Screen

function onReady(callback) {
	var intervalId = window.setInterval(function() {
		if (document.getElementsByTagName('body')[0] !== undefined) {
			window.clearInterval(intervalId);
			callback.call(this);
		}
	}, 1000);
}

function setVisible(selector, visible) {
	document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

onReady(function() {
	setVisible('#loading', false);
});

// Get Browser

getBrowser();

// Menu Funtionality and LocalStorage

$(document).ready(function(){
	
	if (localStorage.getItem("sidebar-page") === "open") { 
	
	} else if (localStorage.getItem("sidebar-page") === "closed") {
		$("#sidebar").addClass("sidebar-close");
		$("#content-wrapper").addClass("content-open");
	}
	
	if (localStorage.getItem("nav-page") === "status") {
		
		var localvalue = localStorage.getItem("nav-page");
		$('.itemBox').not('.' + localvalue).hide('1000');
		$('.itemBox').filter('.' + localvalue).show('1000');
		$('#'+localvalue+'-selector').addClass('active').siblings().removeClass('active');
		
	} else if (localStorage.getItem("nav-page") === "projects") {
		
		var localvalue = localStorage.getItem("nav-page");
		$('.itemBox').not('.' + localvalue).hide('1000');
		$('.itemBox').filter('.' + localvalue).show('1000');
		$('#'+localvalue+'-selector').addClass('active').siblings().removeClass('active');
		
	} else if (localStorage.getItem("nav-page") === "timer") {
		
		var localvalue = localStorage.getItem("nav-page");
		$('.itemBox').not('.' + localvalue).hide('1000');
		$('.itemBox').filter('.' + localvalue).show('1000');
		$('#'+localvalue+'-selector').addClass('active').siblings().removeClass('active');
		
	} else if (localStorage.getItem("nav-page") === "weather") {
		
		var localvalue = localStorage.getItem("nav-page");
		$('.itemBox').not('.' + localvalue).hide('1000');
		$('.itemBox').filter('.' + localvalue).show('1000');
		$('#'+localvalue+'-selector').addClass('active').siblings().removeClass('active');
		
	} else if (localStorage.getItem("nav-page") === "tasks") {
		
		var localvalue = localStorage.getItem("nav-page");
		$('.itemBox').not('.' + localvalue).hide('1000');
		$('.itemBox').filter('.' + localvalue).show('1000');
		$('#'+localvalue+'-selector').addClass('active').siblings().removeClass('active');
		
	} else if (localStorage.getItem("nav-page") === "setting") {
		
		var localvalue = localStorage.getItem("nav-page");
		$('.itemBox').not('.' + localvalue).hide('1000');
		$('.itemBox').filter('.' + localvalue).show('1000');
		$('#'+localvalue+'-selector').addClass('active').siblings().removeClass('active');
		
	} else {
		
	}
	
	$('.selector').click(function(){
	
	const value = $(this).attr('data-filter');
	
	localStorage.setItem('nav-page', value);
	
	if (value == 'all'){
		$('.itemBox').show('1000');
	} else {
		$('.itemBox').not('.' + value).hide('1000');
		$('.itemBox').filter('.' + value).show('1000');
	}
	
	})
	
	$('.nav-link-each').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	})
		
})

function sidebarauto(sidebarmedia) {

	var sidebar = document.getElementById("sidebar");
	var contentwrapper = document.getElementById("content-wrapper");
	
	if (sidebarmedia.matches) {
		sidebar.className += " sidebar-close";
		contentwrapper.className += " content-open";
	} else {

	}
}

var sidebarmedia = window.matchMedia("(max-width: 900px)")
sidebarauto(sidebarmedia)
sidebarmedia.addListener(sidebarauto)

// Timer Options

$("#timertype").change(function(){
    if ($(this).val() == 1){
      $("#timerRutinary").show();
	  $("#timerOcasional").hide();
    } else {
      $("#timerRutinary").hide();
	  $("#timerOcasional").show();
    }

});

// Setting From Delay
	
/*	
$('.setting-form').submit(function (e) {
	var form = this;
	e.preventDefault();
	setTimeout(function () {
		form.submit();
	}, 1000);
});
*/

</script>

</body>

</html>