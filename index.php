<!DOCTYPE html>
<html>

<head>
	<title>CRUD dengan AJAX</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ed14097569.js" crossorigin="anonymous"></script>
	<style type="text/css">
		.form-input input {
			width: 300px;
		}

		#reset {
			width: 80px;
		}

		#address {
			width: 100%;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<h1>Ajax CRUD with bootstrap modals person data</h1>

				<!-- Modal Add Data -->
				<div class="col-md-12" id="add-person">
					<p>
						<a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
							<i class="fas fa-plus"></i>
							Add Person
						</a>
					</p>
					<div class="collapse" id="collapseExample">
						<div id="form-input" class="card card-body">
							<form method="post" id="create-form">
								<table class="form-input">
									<tr>
										<td><label for="first-name">First Name</label></td>
										<td><input type="" name="first-name" id="first-name" placeholder="First Name"></td>
									</tr>
									<tr>
										<td><label for="last-name">Last Name</label></td>
										<td><input type="" name="last-name" id="last-name" placeholder="Last Name"></td>
									</tr>
									<tr>
										<td><label for="gender">Gender</label></td>
										<td>
											<select name="gender" id="gender">
												<option value="" selected="selected">-- Gender --</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>

										</td>
									</tr>
									<tr>
										<td><label for="address">Address</label></td>
										<td><textarea name="address" id="address" rows="10" placeholder="Address"></textarea></td>
									</tr>
									<tr>
										<td><label for="date">Date of Birth</label></td>
										<td><input type="date" name="date" id="date"></td>
									</tr>

									<tr>
										<td></td>
										<td>
											<button class="btn btn-secondary mt-2" id="submit">Submit</button>
											<input class="btn btn-secondary mt-2" type="reset" name="" value="Reset" id="reset">
										</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2">
											<p id="message"></p>
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-md-12 d-flex justify-content-between">
							<div class="show">
								<p>Show
									<select id="show">
										<option value="">-pilih-</option>
									</select>
									Entries
								</p>
							</div>
							<!-- Searching -->
							<div class="search">
								<label for="search">Search</label>
								<input type="" name="search" id="search">
							</div>
						</div>
					</div>

					<!-- Table -->
					<table border="1" style="width:100%">
						<thead>
							<th>No</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Address</th>
							<th>Date Of Birth</th>
							<th>Action</th>
						</thead>
						<tbody id="tbody"></tbody>
					</table>

					<p>showing <span class="sum"></span> of <span class="total-data"></span> entries</p>

				</div>
			</div>
		</div>
	</div>

	<!-- Modal Update Data -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" id="update-form">
						<table>
							<tr>
								<td><label for="first-name-edit">First Name</label></td>
								<td><input type="" name="first-name" id="first-name-edit" placeholder="First Name"></td>
							</tr>
							<tr>
								<td><label for="last-name-edit">Last Name</label></td>
								<td><input type="" name="last-name" id="last-name-edit" placeholder="Last Name"></td>
							</tr>
							<tr>
								<td><label for="gender-edit">Gender</label></td>
								<td>
									<select name="gender" id="gender-edit">
										<option value="">-- Gender --</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>

								</td>
							</tr>
							<tr>
								<td><label for="address-edit">Address</label></td>
								<td><textarea name="address" id="address-edit" cols="30" rows="10" placeholder="Address"></textarea></td>
							</tr>
							<tr>
								<td><label for="date-edit">Date of Birth</label></td>
								<td><input type="date" name="date" id="date-edit"></td>
							</tr>
						</table>


						<div class="modal-footer">
							<input type="hidden" name="id" id="id">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button id="save-edit" type="button" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="script.js"></script>
</body>

</html>