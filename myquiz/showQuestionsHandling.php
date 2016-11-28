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
							<th>Question</th>
							<th>Subject</th>
							<th>Difficulty</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include("dataBase.php");

						$ema = mysqli_query($connect, "SELECT * FROM Galderak");

						while($row=mysqli_fetch_array($ema, MYSQLI_ASSOC)){
							if($row['Difficulty']==0){
								echo '<tr><td>'.$row['Question'].'</td><td>'.$row['Subject'].'</td><td>'."-".'</td></tr>';
							}
							else{
								echo '<tr><td>'.$row['Question'].'</td><td>'.$row['Subject'].'</td><td>'.$row['Difficulty'].'</td></tr>';
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
