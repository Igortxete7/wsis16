<html>
<head>
	<meta charset="utf-8">
	<title>Questions</title>

</head>
<body>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="table-responsive">          
				<table class="table table-hover">
					<thead>
						<tr>
							<th>From Test</th>
							<th>Subject</th>
							<th>Question</th>
							<th>Difficulty</th>
						</tr>
					</thead>
					<tbody>
						<?php
						session_start();
						include("dataBase.php");
						$email = $_SESSION['user-email'];

						$ema = mysqli_query($connect, "SELECT * FROM galderak INNER JOIN testak ON galderak.TestID = testak.ID WHERE Creator='$email'");

						while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
							if($row['Difficulty']==0){
								echo '<tr><td>'.$row['Name'].'</td><td>'.$row['Subject'].'</td><td>'.$row['Question'].'</td><td>'."-".'</td></tr>';
							}
							else{
								echo '<tr><td>'.$row['Name'].'</td><td>'.$row['Subject'].'</td><td>'.$row['Question'].'</td><td>'.$row['Difficulty'].'</td></tr>';
							}
						}
						mysqli_free_result($ema);
						mysqli_close($connect);

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>