$(document).ready(function(){

	let showdata = function(data,limit){
		var total = data.length;
		var per_page = 5;
		var total_page = Math.ceil(total/per_page); 
		var interval = total_page*per_page;

		let elemen = document.querySelector("#show");
		$("#show").html("");	
		// looping nomor	
		for (var angka = 5; angka<=interval; angka+=5) {
			elemen.innerHTML += `<option value="${angka}">${angka}</option>`;
		}
		$('#show option').each(function() {
		    if($(this).val() == limit) {
		        $(this).prop("selected", true);
		  	}
		  });
	
	}
		
	// Tambah table row 
	let tbody = $("#tbody");
	let table = function(data){
		tbody.html("");
		if(data.length>0){
			data.forEach(function(value, index){
				tbody.append(`
					<tr>
						<td id="no"><span>${index+1}</span></td>
						<td id="first"><span>${value.first_name}</span></td>
						<td id="last"><span>${value.last_name}</span></td>
						<td id="gender"><span>${value.gender}</span></td>
						<td id="add"><span>${value.address}</span></td>
						<td id="birth"><span>${value.date_of_birth}</span></td>
						<td>
							<a class="btn btn-primary" data="${value.id}" id="edit" data-toggle="modal" data-target="#exampleModal" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-pencil-alt"></i>Edit</a>
							<button class="btn btn-danger" id="delete" data="${value.id}"><i class="fas fa-trash-alt"></i> Delete</button>		
						</td>
					</tr>
				`)
			})
		}					
	};

	// CRUD
	let app = {
		// Read Data 
		show : function(limit){
			// tampilkan data dari database
			$.get("show.php?limit="+limit, function(response){
				let data = JSON.parse(response);
				table(data);
			})
		},
		showop : function(limit){
			$.get("showoption.php", function(response){
				let dt = JSON.parse(response);
				showdata(dt,limit);
			})
		},

		// Pesan 
		message : function(response){
			$("#message").html(response).css({"color":"red"}).slideDown('fast');
			setTimeout(function(){
				$("#message").html("")
			}, 3000);
		},

		// Simpan Data
		save : function(){

			let errorMessage = null; 
			let firstName = $("#first-name").val();
			let lastName = $("#last-name").val();
			let gen = $("#gender").val();
			let add = $("#address").val();
			let dateTime = $("#date").val();
			
			// validasi error
			if(firstName === ""){
				errorMessage = "mohon isikan nama depan";
			} else if(lastName === ""){
				errorMessage = "mohon isikan nama belakang";
			} else if(gen === ""){
				errorMessage = "mohon pilih gender";
			} else if(add === ""){
				errorMessage = "mohon isikan alamat";
			} else if(dateTime === ""){
				errorMessage = "mohon isikan tgl lahir";
			}else{
				$("#collapseExample").attr("class", "collapse");
				$("#first-name").val("");
				$("#last-name").val("");
				$("#gender").val("");
				$("#address").val("");
				$("#date").val("");
			}
			

			// Jalankan Fungsi Error
			if(errorMessage){
				app.message(errorMessage);
				return false;
			}
			// Melakukan request POST untuk simpan data
			$.post("save.php",{
					fname : firstName,
					lname : lastName,
					gender : gen,
					address : add,
					date : dateTime,
					type : "insert"
				},
				function(){
					firstName;
					lastName ;
					gen ;
					add ;
					dateTime; 
				})
			
			let limit = $("#show").val();
			app.show(limit);
			app.showop(limit);			
		},

		// delete data 
		delete: function(id){
			$.ajax({
			 	url: "delete.php",
			 	method : "POST",
			 	data:{id_del:id, type:"delete"},
			 	success: function(response){
			 		app.message(response);
			 	}
			})
			let limit = $("#show").val();
			app.show(limit);
			app.showop(limit);	
		},

		// Edit Data
		edit: function(id){
			$.get("edit.php?edit="+id, function(response){
				let edit = JSON.parse(response);
				app.showedit(edit);
			})
		},

		// Tampil Data Edit 
		showedit: function(data){
			let fnShowedit = $("#first-name-edit").val(data.first_name);
			let lnShowedit = $("#last-name-edit").val(data.last_name);
			let gen = data.gender;
			let genShowedit = $('#gender-edit option').each(function() {
							    if($(this).val() == gen) {
							        $(this).prop("selected", true);
							  	}
							  });
			let addShowedit = $("#address-edit").val(data.address);
			let dateShowedit = $("#date-edit").val(data.date_of_birth);
			let idShowedit = $("#id").val(data.id);
		},

		// input data edit
		inputedit : function(){
			let fnInputedit = $("#first-name-edit").val();
			let lnInputedit = $("#last-name-edit").val();
			let genInputedit = $("#gender-edit").val();
			let addInputedit = $("#address-edit").val();
			let dateInputedit = $("#date-edit").val();
			let idInputedit = $("#id").val();
			
			//Request POST untuk edit data
			$.post("input-edit.php",{
				fname : fnInputedit,
				lname : lnInputedit,
				gender : genInputedit,
				address : addInputedit,
				date : dateInputedit,
				id : idInputedit,
				type : "update",
			}, function(){
				fnInputedit; 
				lnInputedit;
				genInputedit;
				addInputedit;
				dateInputedit;
				idInputedit;
			})
			let limit = $("#show").val();
			app.show(limit);
			app.showop(limit);		
		},

		// Fungsi live search AJAX
		search: function(keyword){
			$.get("search.php?search="+keyword, function(response){
				let data = JSON.parse(response);
				tbody.html("");
				table(data);
			})
		}
	
	}

	// Jalankan Fungsi
	app.show(5);
	app.showop();
		
	// $("#create-form").on("submit", app.save);
	$(document).on("click", "#submit", function(e){
		e.preventDefault()
		app.save();

	});
	$("#reset").on("click", function(){
		$("#collapseExample").attr("class", "collapse")
	});
	$(document).on("click","#delete", function(){
		let idDel = $(this).attr("data");
		tbody.html("");
		app.delete(idDel);
	});
	$(document).on("click", "#edit", function(){
		let idEdit = $(this).attr("data");
		app.edit(idEdit);
	});
	$(document).on("click", "#save-edit", function(){
		// Hide Modal
		$('#exampleModal').modal('hide');
		app.inputedit();

	});
	$("#search").on("keyup", function(){
		let keyword = $(this).val();
		app.search(keyword);
	});

	$("#show").on("change", function(){
		let limit = $(this).val();
		tbody.html("");
		app.show(limit);
	})

})