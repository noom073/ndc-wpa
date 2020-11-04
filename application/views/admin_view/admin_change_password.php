<section>
	<div class="container-fluid">
		<div>
			<div class="shadow m-2 p-3">
				<div class="lead">
					<h2>Admin เปลี่ยนรหัสผ่าน:</h2>
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
							return `${data}`;
                        }
                    },
					{data: null,
						render: (data,type,row,meta) =>{
							var $change_button = `<button class="btn btn-primary change-password" data-change-password = "${row.row_id}" >Chg pwd.</button>`

							return `${$change_button}`
						}
					 }
				]
			});
		}

        gentable();

		$(document).on('click', '.change-password', function() {
			var id = $(this).attr('data-change-password');
			$("input[name='id']").val(id);
			$('#user-detail-modal').modal();
		});
		
        $('#repass-form').submit(function(){
            var formData = $(this).serialize();
			// console.log(formData);
			$.ajax({
				url:'<?= site_url('admin/ajax_change_password')?>',
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

        $("#show-pass").click(function() {
            var type = $("#password").attr('type');
            if (type == 'password') {
                $("#password").attr('type', 'text');
            } else {
                $("#password").attr('type', 'password');
            }
        });

	});
</script>