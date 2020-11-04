<section>
	<div class="container-fluid">
		<div>
			<div class="shadow m-2 p-3">
				<div class="lead">
					<h2>ค้นหาข้อมูล:</h2>
					<span id="loading"></span>
				</div>
				<form class="form-inline" id='search-form'>
					<div class="input-group mb-2 mr-sm-2">
						<select class="form-control mb-2 mr-sm-2" name="course" title="หลักสูตร">
							<option value="">ไม่ระบุ</option>
							<?php foreach($course as $r){?>
								<?php if ($r['course'] != '') {?>
									<option value="<?=$r['course']?>"><?=$r['course']?></option>	
								<?php  }?>							
							<?php }?> 				
						</select>
					</div>

					<div class="input-group mb-2 mr-sm-2" >
					  	<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="ชื่อ" name="firstname">
					</div>

				    <div class="input-group mb-2 mr-sm-2">
				    	<input type="text" class="form-control" id="inlineFormInputGroupUsername1" placeholder="นามสกุล" name="lastname">
				  	</div>

				  	<div class="input-group mb-2 mr-sm-2">
				    	<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="หมู่" name="squad">
				  	</div>

					  <button type="submit" class="btn btn-primary mb-2">Submit</button>
				</form>
			</div>

			<div class="shadow m-2 p-3">
				<div class="table-responsive">
					<table class="table table-bordered" id="gentable">
						<thead>
							<tr>
								<th>หลักสูตร</th>
								<th>ชื่อ-นามสกุล</th>
								<th>ตำแหน่ง</th>
								<th>อีเมล</th>
								<th>หมู่</th>
							</tr>
						</thead>
					</table>
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
					{data: 'course_name'},						
					{data: null,
						render: function(data, type, row, meta){
							return `${row.title} ${row.first_name}  ${row.last_name}`;
						}
					},
					{data: 'position_name'},
					{data: 'email'},
					{data: 'squad_name'}
				],
				fnInitComplete: function() {
					$("#loading").text('');
				}
			});
		}
	});
</script>