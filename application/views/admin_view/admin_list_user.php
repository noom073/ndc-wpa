<section>
	<div class="container-fluid">
		<div>
			<div class="shadow m-2 p-3">
				<div class="lead">
					<h2>Admin ค้นหาข้อมูลผู้ใช้:</h2>
				</div>
			</div>

			<div class="shadow m-2 p-3">
				<div class="text-center">
					<p id="list-result"></p>
				</div>
				<div class="table-responsive">	
					<table class="table table-bordered" id="gentable">
						<thead>
							<tr>
								<th>username</th>
								<th>ชื่อ-นามสกุล</th>
								<th>หลักสูตร</th>
								<th>ประเภท</th>
								<th>active</th>
								<th>แก้ไข</th>
							</tr>
						</thead>
					</table>
				</div>	
			</div>				
		</div>		
	</div>
	<!-- Modal -->
	<div class="modal fade" id="user-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<h5 class="modal-title text-light" id="exampleModalLabel">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="user-form">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>หลักสูตร</label>
								<input type="text" name="course_name" class="form-control">	
							</div>					
							<div class="form-group col-md-4">
								<label>เลขนักศึกษา</label>
								<input type="text" name="student_id" class="form-control">	
							</div>					
							<div class="form-group col-md-4">
								<label>เบอร์โทรศัพท์</label>
								<input type="text" name="tel_num" class="form-control">	
							</div>					
						</div>

						<div  class="form-row">
							<div class="form-group col-md-4">
								<label>คำนำหน้าชื่อ</label>
								<input type="text" name="title" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>ชื่อ</label>
								<input type="text" name="first_name" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>นามสกุล</label>
								<input type="text" name="last_name" class="form-control">
							</div>
						</div>
						<div  class="form-row">
							<div class="form-group col-md-4">
								<label>ประเภท</label>
								<select name = "type" class="form-control">
                                    <option value="admin">admin</option>
                                    <option value="normal">normal</option>
                                </select>
							</div>
							<div class="form-group col-md-4">
								<label>active</label>
                                <select name ="active" class="form-control">
                                    <option value="y">active</option>
                                    <option value="n">inactive</option>
                                </select>
							</div>
						</div>
						<input type="hidden" name="id">
						<p id="result"></p>
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
		function gentable(){
			$('#gentable').DataTable({
				destroy: true,
				ajax: {
					url: '<?= site_url("admin/ajax_list_user")?>',
					dataSrc:''
				},
				columns: [
					{data: 'username'},
					{data: null,
						render: function(data, type, row, meta){
							return `${row.title} ${row.first_name}  ${row.last_name}`;
						}
					},
					{data: 'course_name'},
					{data: 'type'},
                    {data: 'active',
                        render: function(data, type, row, meta){
							if (data == 'y') {
								var active_name = 'active';
							} else {
								var active_name = 'inactive';
							}
							return `${active_name}`;
                        }
                    },
					{data: null,
						render: (data,type,row,meta) =>{
							var $del_button = `<button class="btn btn-danger delete-user" data-row-id = "${row.row_id}" >ลบ</button>`
							var $edit_button = `<button class="btn btn-primary edit-user" data-user-id = "${row.row_id}" >แก้ไข</button>`

							return `${$edit_button} ${$del_button}`
						}
					 }
				]
			});
		}

        gentable();

		$(document).on('click', '.edit-user', function() {
			var id = $(this).attr('data-user-id');
			$.ajax({
				url:'<?= site_url('admin/ajax_get_oneuser')?>',
				data: {user_id:id},
				type:'post',
				dataType:'json',
				success: ($data) => {
					$('#user-form').find("input[name='id']").val($data.row_id);
					$('#user-form').find("input[name='title']").val($data.title);
					$('#user-form').find("input[name='course_name']").val($data.course_name);
					$('#user-form').find("input[name='last_name']").val($data.last_name);
					$('#user-form').find("input[name='first_name']").val($data.first_name);
					$('#user-form').find("input[name='student_id']").val($data.student_id);
					$('#user-form').find("input[name='tel_num']").val($data.tel_num);
                    if ($data.type == 'admin') {
                        var option = `<option value="admin" selected>admin</option>
                            <option value="normal">normal</option>`;
                    } else {
                        var option = `<option value="admin">admin</option>
                            <option value="normal" selected>normal</option>`;
                    }
                    $('#user-form').find("select[name='type']").html(option);

                    if ($data.active == 'y') {
                        var option = `<option value="y" selected>active</option>
                            <option value="n">inactive</option>`;
                    } else {
                        var option = `<option value="y">active</option>
                            <option value="n" selected>inactive</option>`;
                    }
                    $('#user-form').find("select[name='active']").html(option);

                    $("#result").attr('class','');					
                    $("#result").text('');	
					$('#user-detail-modal').modal();

				},
				error: ($jhr,$status,$error) => {
					console.log($jhr,$status,$error);
				}
			});
		});
        $('#user-form').submit(function(){
            var formData = $(this).serialize();
			// console.log(formData);
			$.ajax({
				url:'<?= site_url('admin/ajax_update_user')?>',
				data: formData,
				type:'post',
				dataType:'json',
				success: ($data) => {
					console.log($data);
					if ($data.status) {
						$("#result").attr('class','alert alert-info');					
						$("#result").text($data.text);	

						gentable();	

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
		$(document).on('click', '.delete-user', function() {
			var $row_id = $(this).attr('data-row-id');
			// console.log($row_id);
			var message = 'ยืนยันการลบ';
			if (confirm(message)) {
				$.ajax({
					url:'<?= site_url('admin/ajax_delete_user')?>',
					data: {row_id : $row_id},
					type:'post',
					dataType:'json',
					success: ($data) => {
						// console.log($data);
						if ($data.status) {
							$("#list-result").attr('class','alert alert-info');					
							$("#list-result").text($data.text);	

							gentable();				
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

	});
</script>