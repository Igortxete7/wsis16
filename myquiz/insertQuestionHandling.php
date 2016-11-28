<html>
<body>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<p align="center">Insert any kind of question in the first field and the answer below. <br> If you want you can specify the difficulty.</p>
			<br>
			<form id="question" name="question">
				<div class="form-group form-inline">
					<label for="question" style="width:12%">Question:</label>
					<input type="text" style="width:87%" name="question" id="Question" class="form-control" placeholder="Enter your question" required>
				</div>
				<div class="form-group form-inline">
					<label for="answer" style="width:12%">Answer:</label>
					<input type="text" style="width:87%" name="answer" id="Answer" class="form-control" placeholder="Enter your answer" required>
				</div>
				<br>
				<div class="form-group form-inline">
					<label for="subject" style="width:12%">Subject:</label>
					<input type="text" style="width:87%" name="subject" id="subject" class="form-control" placeholder="Enter the subject">
				</div>
				<div class="form-group form-inline" >
					<label for="difficulty" style="width:12%">Difficulty:</label>
					<select class="form-control" style="width:87%" name="diff" id="Diff">
						<option value=""></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<button class="btn btn-primary btn-block" name="submit" onclick="insert()">Add question</button>
			</form>
			<br><br><br><br><br>
		</div>

	</div>
</body>
</html>