<section>
	<div class="container-fluid">
		<div>
			<div class="shadow m-2 p-3">
				<div class="lead">
					<h2>Admin ค้นหาข้อมูล:</h2>
					<span id="loading"></span>
				</div>
				<form class="form-inline" id='search-form'>
					<div class="input-group mb-2 mr-sm-2">
						<select class="form-control" name="course" title="หลักสูตร">
							<option value="">ไม่ระบุ</option>
							<?php foreach($course as $r){?>
								<?php if ($r['course'] != '') {?>
									<option value="<?=$r['course']?>"><?=$r['course']?></option>	
								<?php  }?>
							
							<?php }?> 				
						</select>
					</div>

					<div class="input-group mb-2 mr-sm-2" >
					  	<input type="text" class="form-control" id="inlineFormInputName2" placeholder="ชื่อ" name="firstname">
					</div>

				    <div class="input-group mb-2 mr-sm-2">
				    	<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="นามสกุล" name="lastname">
				  	</div>

				  	<div class="input-group mb-2 mr-sm-2">
				    	<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="หมู่" name="squad">
				  	</div>
					  
					<button type="submit" class="btn btn-primary mb-2">Submit</button>

							

				</form>
					
			</div>

			<div class="shadow p-3 m-2">
				<form id = "fileupload-form" enctype="multipart/form-data">
					<input type="file" name = "file">
					<button class = "btn btn-primary">uploadfile</button>	
					<div id="upload-detail" class="p-3">
						<p id="upload-rs"></p>
						<p id="pass-std"></p>
						<p id="err-std"></p>
						<p id="dup-std"></p>
					</div>							
				</form>
			</div>

			<div class="shadow m-2 p-3">
				<div class="text-center">
					<p id="list-result"></p>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered" id="gentable">
						<thead>
							<tr>
								<th>เลขสมาชิก</th>
								<th>หลักสูตร</th>
								<th>ชื่อ-นามสกุล</th>
								<th>ตำแหน่ง</th>
								<th>อีเมล</th>
								<th>หมู่</th>
								<th>แก้ไข</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>				
		</div>		
	</div>
	<!-- Modal -->
	<div class="modal fade" id="st-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<h5 class="modal-title text-light" id="exampleModalLabel">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="student-form">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>เลขนักศึกษา</label>
								<input type="text" name="student_id" class="form-control">
							</div>	
							<div class="form-group col-md-4">
								<label>หลักสูตร</label>
								<input type="text" name="course" class="form-control">	
							</div>					
						</div>

						<div  class="form-row">
							<div class="form-group col-md-4">
								<label>คำนำหน้าชื่อ</label>
								<input type="text" name="title" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>ชื่อ</label>
								<input type="text" name="firstname" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>นามสกุล</label>
								<input type="text" name="lastname" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>ตำแหน่ง</label>
								<input type="text" name="position" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>ที่อยู่1</label>
								<input type="text" name="addr1" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label>ที่อยู่2</label>
								<input type="text" name="addr2" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label>จังหวัด</label>
								<input type="text" name="province" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label>เบอร์โทรศัพท์</label>
								<input type="text" name="tel1" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>เบอร์ที่ทำงาน</label>
								<input type="text" name="tel2" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>เบอร์มือถือ</label>
								<input type="text" name="mobile" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>แฟกซ์</label>
								<input type="text" name="fax" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label>อีเมล</label>
								<input type="text" name="email" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>วัน เดือน ปีเกิด</label>
								<input type="text" name="birthday" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>คู่สมรส</label>
								<input type="text" name="spouse" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>ชื่อเล่น</label>
								<input type="text" name="nickname" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label>ชื่อหมู่</label>
								<input type="text" name="squad" class="form-control">
							</div>
						</div>
						<div class="form-row">
							<p id="result"></p>
						</div>
						<input type="hidden" name="id">
						
							<button class="btn btn-info" >save</button>
							<button class="btn btn-danger" data-dismiss="modal" aria-label="Close">close</button>
						
					</form>
				</div>
				
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {
		$("#search-form").submit(function(){
			$("#loading").text('กำลังโหลดข้อมูล...');
			var _formData = {
				course: $(this).find("select[name='course']").val(),
				firstname: $(this).find("input[name='firstname']").val(),
				lastname: $(this).find("input[name='lastname']").val(),
				squad: $(this).find("input[name='squad']").val()
			}
			gentable(_formData);
			return false;
		});

		function gentable(dataForm){
			$('#gentable').DataTable({
				destroy: true,
				ajax: {
					url: '<?= site_url("main/ajax_get_student_normal")?>',
					data: dataForm,
					type: 'post',
					dataSrc:''
				},
				columns: [
					{data: 'student_id'},
					{data: 'course_name'},						
					{data: null,
						render: function(data, type, row, meta){
							return `${row.title} ${row.first_name}  ${row.last_name}`;
						}
					},
					{data: 'position_name'},
					{data: 'email'},
					{data: 'squad_name'},
					{data: null,
						render: (data,type,row,meta) =>{
							var $del_button = `<button class="btn btn-danger delete-std" data-row-id = "${row.row_id}" >ลบ</button>`
							var $edit_button = `<button class="btn btn-primary edit-std" data-std-id = "${row.student_id}" >แก้ไข</button>`

							return `${$edit_button} ${$del_button}`
						}
					 }
				],
				fnInitComplete: function() {
					$("#loading").text('');
				}
			});
		}

		// $('.edit-std').click(function(){
		$(document).on('click', '.edit-std', function() {
			var id = $(this).attr('data-std-id');
			console.log(id);
			$.ajax({
				url:'<?= site_url('admin/ajax_get_student_detail')?>',
				data: {student_id:id},
				type:'post',
				dataType:'json',
				success: ($data) => {
					console.log($data);
					$('#student-form').find("input[name='title']").val($data.title);
					$('#student-form').find("input[name='course']").val($data.course_name);
					$('#student-form').find("input[name='student_id']").val($data.student_id);
					$('#student-form').find("input[name='lastname']").val($data.last_name);
					$('#student-form').find("input[name='firstname']").val($data.first_name);
					$('#student-form').find("input[name='spouse']").val($data.spouse);
					$('#student-form').find("input[name='birthday']").val($data.birth_day);
					$('#student-form').find("input[name='squad']").val($data.squad_name);
					$('#student-form').find("input[name='nickname']").val($data.nick_name);
					$('#student-form').find("input[name='email']").val($data.email);
					$('#student-form').find("input[name='addr1']").val($data.address1);
					$('#student-form').find("input[name='addr2']").val($data.address2);
					$('#student-form').find("input[name='tel1']").val($data.tel1);
					$('#student-form').find("input[name='tel2']").val($data.work_tel);
					$('#student-form').find("input[name='fax']").val($data.fax);
					$('#student-form').find("input[name='province']").val($data.address_province);
					$('#student-form').find("input[name='position']").val($data.position_name);
					$('#student-form').find("input[name='mobile']").val($data.mobile);
					$('#student-form').find("input[name='id']").val($data.row_id);
					$('#st-detail-modal').modal();
				},
				error: ($jhr,$status,$error) => {
					console.log($jhr,$status,$error);
				}
			});
		});
		$("#student-form").submit(function() {
			var formData = $(this).serialize();
			// console.log(formData);
			$.ajax({
				url:'<?= site_url('admin/ajax_update_student')?>',
				data: formData,
				type:'post',
				dataType:'json',
				success: ($data) => {
					console.log($data);
					if ($data.status) {
						$("#result").attr('class','alert alert-info');					
						$("#result").text($data.text);	
						$("#result").fadeOut(3000);	

						var _formData = {
							course: $(this).find("select[name='course']").val(),
							firstname: $(this).find("input[name='firstname']").val(),
							lastname: $(this).find("input[name='lastname']").val(),
							squad: $(this).find("input[name='squad']").val()
						}
						gentable(_formData);	

					} else {
						$("#result").attr('class','alert alert-danger');					
						$("#result").text($data.text);					
					}				
				},
				error: ($jhr,$status,$error) => {
					console.log($jhr,$status,$error);
				}
			});
			return false;
		});

		$(document).on('click', '.delete-std', function() {
			var $row_id = $(this).attr('data-row-id');
			// console.log($row_id);
			if(confirm('ยืนยันการลบ')){
				$.ajax({
					url:'<?= site_url('admin/ajax_delete_student')?>',
					data: {row_id : $row_id},
					type:'post',
					dataType:'json',
					success: ($data) => {
						console.log($data);
						if ($data.status) {
							$("#list-result").attr('class','alert alert-info');					
							$("#list-result").text($data.text);	

							var _formData = {
								course: $("#search-form").find("select[name='course']").val(),
								firstname: $("#search-form").find("input[name='firstname']").val(),
								lastname: $("#search-form").find("input[name='lastname']").val(),
								squad: $("#search-form").find("input[name='squad']").val()
							}
							gentable(_formData);				
						} else {
							$("#list-result").attr('class','alert alert-danger');					
							$("#list-result").text($data.text);					
						}					
					},
					error: ($jhr,$status,$error) => {
						console.log($jhr,$status,$error);
					}
				});
			} else {
				return false;
			}
			
		});
		$('#fileupload-form').submit(function(){
			var message = 'ยืนยันการอัพโหลดไฟล์';
			if (confirm(message)) {

				$("#upload-rs").text('Loading...');
				var formData = new FormData(this);
				$.ajax({
					type: "POST",
					url: '<?= site_url("admin/ajax_uploadfile")?>',
					data: formData,
					processData: false,  // tell jQuery not to process the data
					contentType: false,  // tell jQuery not to set contentType
					dataType: 'json',
					success: function (data) {
						if(data.pass_student) {
							var text = '<span class="h4">บันทึกข้อมูลสำเร็จ</span><br>';
							data.pass_student.forEach( x => {
								text += `<span>เลขสมาชิก:${x.id} :${x.name} </span><br>`;
							});
							$("#pass-std").html(text);
						}
						if(data.err_student) {
							var text = '<span class="h4">บันทึกข้อมูลไม่สำเร็จ</span><br>';
							data.err_student.forEach( x => {
								text += `<span>เลขสมาชิก:${x.id} :${x.name} </span><br>`;
							});
							$("#err-std").html(text);
						}
						if(data.dup_student !== 'undefined') {
							var text = '<span class="h4">เลขสมาชิกซ้ำ</span><br>';
							data.dup_student.forEach( x => {
								text += `<span>เลขสมาชิก:${x.id} :${x.name} </span><br>`;
							});
							$("#dup-std").html(text);
						}
						$("#upload-rs").text('');
						$("#upload-detail").fadeOut(6000);
					},
					error: ($jhr,$status,$error) => {
						console.log($jhr,$status,$error);
					}
				});
				return false;
				
			} else {
				return false;
			}
		});
	});
</script>