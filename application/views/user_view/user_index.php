<section>
	<div class="container-fluid">
		<div>
			<div class="shadow m-2 p-3">
				<div class="lead">
					<h2>ค้นหาข้อมูล:</h2>
					<span id="loading"></span>
				</div>
				<form class="form-inline" id='search-form'>
					<div class="div-group mb-2 mr-sm-2">
						<select class="form-control" name="course" title="หลักสูตร">
							<option value="">ไม่ระบุ</option>
							<?php foreach($course as $r){?>
								<?php if ($r['course'] != '') {?>
									<option value="<?=$r['course']?>"><?=$r['course']?></option>	
								<?php  }?>
							
							<?php }?> 				
						</select>
					</div>

					<div class="div-group mb-2 mr-sm-2" >
					  	<input type="text" class="form-control" id="inlineFormdivName2" placeholder="ชื่อ" name="firstname">
					</div>

				    <div class="div-group mb-2 mr-sm-2">
				    	<input type="text" class="form-control" id="inlineFormdivGroupUsername1" placeholder="นามสกุล" name="lastname">
				  	</div>

				  	<div class="div-group mb-2 mr-sm-2">
				    	<input type="text" class="form-control" id="inlineFormdivGroupUsername2" placeholder="หมู่" name="squad">
				  	</div>
					  
					<button type="submit" class="btn btn-primary mb-2">Submit</button>

							

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
					<h5 class="modal-title text-light" id="exampleModalLabel">รายละเอียดข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="student-detail">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>เลขนักศึกษา</label>
								<div id="student_id" class="form-control"></div>
							</div>	
							<div class="form-group col-md-4">
								<label>หลักสูตร</label>
								<div id="course" class="form-control"></div>	
							</div>					
						</div>

						<div  class="form-row">
							<div class="form-group col-md-4">
								<label>คำนำหน้าชื่อ</label>
								<div id="title" class="form-control"></div>
							</div>
							<div class="form-group col-md-4">
								<label>ชื่อ</label>
								<div id="firstname" class="form-control"></div>
							</div>
							<div class="form-group col-md-4">
								<label>นามสกุล</label>
								<div id="lastname" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-12">
								<label>ตำแหน่ง</label>
								<div id="position" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-12">
								<label>ที่อยู่1</label>
								<div id="addr1" class="form-control"></div>
							</div>
						</div>
                        <div class="form-row">
							<div class="form-group col-md-12">
								<label>ที่อยู่2</label>
								<div id="addr2" class="form-control"></div>
							</div>
                        </div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>จังหวัด</label>
								<div id="province" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label>เบอร์โทรศัพท์</label>
								<div id="tel1" class="form-control"></div>
							</div>
							<div class="form-group col-md-4">
								<label>เบอร์ที่ทำงาน</label>
								<div id="tel2" class="form-control"></div>
							</div>
							<div class="form-group col-md-4">
								<label>เบอร์มือถือ</label>
								<div id="mobile" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>แฟกซ์</label>
								<div id="fax" class="form-control"></div>
							</div>
							<div class="form-group col-md-6">
								<label>อีเมล</label>
								<div id="email" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>วัน เดือน ปีเกิด</label>
								<div id="birthday" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>คู่สมรส</label>
								<div id="spouse" class="form-control"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>ชื่อเล่น</label>
								<div id="nickname" class="form-control"></div>
							</div>
							<div class="form-group col-md-6">
								<label>ชื่อหมู่</label>
								<div id="squad" class="form-control"></div>
							</div>
						</div>
                            <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">close</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>
	<!-- Modal -->
<div class="modal fade" id="user-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<h5 class="modal-title text-light" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="repass-form">
						<div  class="form-row">
							<div class="form-group col-md-4">
								<label>password</label>
								<input name ="password" type="password" id="password" class="form-control">
                                <input type="checkbox" name="show_pass" id="show-pass">show password
							</div>					
						</div>
						<input type="hidden" name="id">
						<p id="password-result"></p>
							<button class="btn btn-info" >save</button>
							<button class="btn btn-danger" data-dismiss="modal" aria-label="Close">close</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
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
							var $detail_button = `<button class="btn btn-primary detail-std" data-std-id = "${row.row_id}" >รายละเอียด</button>`

							return `${$detail_button}`
						}
					 }
				],
				fnInitComplete: function() {
					$("#loading").text('');
				}
			});
		}

		// $('.edit-std').click(function(){
		$(document).on('click', '.detail-std', function() {
			var id = $(this).attr('data-std-id');
			console.log(id);
			$.ajax({
				url:'<?= site_url('user/ajax_get_student_detail')?>',
				data: {student_id:id},
				type:'post',
				dataType:'json',
				success: ($data) => {
					console.log($data);
					$('#student-detail').find("div[id='title']").text($data.title);
					$('#student-detail').find("div[id='course']").text($data.course_name);
					$('#student-detail').find("div[id='student_id']").text($data.student_id);
					$('#student-detail').find("div[id='lastname']").text($data.last_name);
					$('#student-detail').find("div[id='firstname']").text($data.first_name);
					$('#student-detail').find("div[id='spouse']").text($data.spouse);
					$('#student-detail').find("div[id='birthday']").text($data.birth_day);
					$('#student-detail').find("div[id='squad']").text($data.squad_name);
					$('#student-detail').find("div[id='nickname']").text($data.nick_name);
					$('#student-detail').find("div[id='email']").text($data.email);
					$('#student-detail').find("div[id='addr1']").text($data.address1);
					$('#student-detail').find("div[id='addr2']").text($data.address2);
					$('#student-detail').find("div[id='tel1']").text($data.tel1);
					$('#student-detail').find("div[id='tel2']").text($data.work_tel);
					$('#student-detail').find("div[id='fax']").text($data.fax);
					$('#student-detail').find("div[id='province']").text($data.address_province);
					$('#student-detail').find("div[id='position']").text($data.position_name);
					$('#student-detail').find("div[id='mobile']").text($data.mobile);
					$('#student-detail').find("div[id='id']").text($data.row_id);
					$('#st-detail-modal').modal();
				},
				error: ($jhr,$status,$error) => {
					console.log($jhr,$status,$error);
				}
			});
		});
		$("#student-detail").submit(function() {
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
							firstname: $(this).find("div[name='firstname']").val(),
							lastname: $(this).find("div[name='lastname']").val(),
							squad: $(this).find("div[name='squad']").val()
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
							firstname: $("#search-form").find("div[name='firstname']").val(),
							lastname: $("#search-form").find("div[name='lastname']").val(),
							squad: $("#search-form").find("div[name='squad']").val()
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

		$("#show-pass").click(function() {
            var type = $("#password").attr('type');
            if (type == 'password') {
                $("#password").attr('type', 'text');
            } else {
                $("#password").attr('type', 'password');
            }
        });

		$("#changepass").click(function(){
			$("#user-password-modal").modal();
		});

		$("#repass-form").submit(function(event){
			event.preventDefault();
			var formData = $(this).serialize();

			$.ajax({
				url:"<?=base_url('user/ajax_change_password')?>",
				data: formData,
				type:"post",
				dataType:"json",
				success:function(data){
					console.log(data);
					if (data.status) {
						$("#password-result").attr('class','alert alert-info');					
						$("#password-result").text(data.text);											
					} else {
						$("#password-result").attr('class','alert alert-danger');					
						$("#password-result").text(data.text);					
					}	
				},
				error:function(jhr,status,error){
					console.log(jhr,status,error);
				}
			});
			console.log(formData);

		});
	});
</script>