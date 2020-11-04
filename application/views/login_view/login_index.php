<section>
	<div class="container-fluid">
		<div class="container">			
			<div class="shadow-lg col-md-6 offset-md-3 p-5">
				<h1 class="display-4 text-center">เข้าสู่ระบบ</h1>
				<div class="mt-5">
					<form id="login-form">
						<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<div id="result"></div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>				
			</div>
		</div>
	</div>
</section>
<section>
	<!-- Modal -->
	<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<h5 class="modal-title text-light" id="exampleModalLabel">ลงทะเบียน</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="register-form">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>หลักสูตร</label>
								<select class="form-control" name="course" title="หลักสูตร">
									<?php foreach($course as $r){?>
										<?php if ($r['course'] != '') {?>
											<option value="<?=$r['course']?>"><?=$r['course']?></option>	
										<?php  }?>
									<?php }?> 				
								</select>	
							</div>	
							<div class="form-group col-md-4">
								<label>เลขนักศึกษา</label>
								<input type="text" name="student_id" class="form-control" required>	
							</div>				
							<div class="form-group col-md-4">
								<label>เบอร์โทรศัพท์</label>
								<input type="text" name="tel_num" class="form-control" required>	
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
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>username</label>
								<input type="text" name="user" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label>password</label>
								<input type="password" name="password" class="form-control" value="555">
							</div>
						</div>

						<div class="form-row">
							<p id="reg-result"></p>
						</div>
						<button class="btn btn-info g-recaptcha" data-size="invisible" data-sitekey="6LdFrMEUAAAAAH4F2z12EKmp3lXh8do89B_PUsn0" data-callback='onSubmit' >save</button>
						<button class="btn btn-danger" data-dismiss="modal" aria-label="Close">close</button>
						
					</form>
				</div>
				
			</div>
		</div>
	</div>
	<div class="text-center m-3">
		<p>พัฒนาโดย กพร.ศทส.สส.ทหาร</p>
		<a href="<?= site_url('main')?>">หน้าหลัก</a> | <a href="#" id="show-register-modal">ลงทะเบียน</a>
	</div>
</section>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
	console.log(document.getElementsByName("title")[0].value);
	function onSubmit(token) {
		if (
			document.getElementsByName("title")[0].value.trim() == '' ||
			document.getElementsByName("course")[0].value.trim() == '' ||
			document.getElementsByName("first_name")[0].value.trim() == '' ||
			document.getElementsByName("last_name")[0].value.trim() == '' ||
			document.getElementsByName("user")[0].value.trim() == '' ||
			document.getElementsByName("student_id")[0].value.trim() == '' ||
			document.getElementsByName("tel_num")[0].value.trim() == '' ||
			document.getElementsByName("password")[1].value.trim() == ''
		) {
			$('#reg-result').text('กรุณากรอกข้อมูลให้ครบถ้วน');
			$('#reg-result').attr('class','alert alert-danger');
			grecaptcha.reset();
			
			console.log('fail');

		} else {
			var _formData = $('#register-form').serialize();
			$.ajax({
				url:'<?= site_url('login_wpa/ajax_register_process')?>',
				data: _formData,
				type:'post',
				dataType:'json',
				success: ($data) => {
					console.log($data);

					if ($data.status) {
						$('#reg-result').text($data.text);
						$('#reg-result').attr('class','alert alert-success');
						
					} else {
						$('#reg-result').text($data.text);
						$('#reg-result').attr('class','alert alert-danger');
					}
				},
				error: ($jhr,$status,$error) => {
					console.log($jhr,$status,$error);
				}
			});
		}
	}

	$(document).ready(function() {
		$("#login-form").submit(function(){
			var _formData = {
				name: $(this).find("input[name='name']").val(),
				password: $(this).find("input[name='password']").val(),
			}
			$.ajax({
				url:'<?= site_url('login_wpa/ajax_login_process')?>',
				data: _formData,
				type:'post',
				dataType:'json',
				success: ($data) => {
					console.log($data);
					if ($data.status) {
						$('#result').text($data.text);
						$('#result').attr('class','alert alert-success');
						setTimeout( () => {
							if ($data.type == 'admin') {
								window.location.replace('<?= site_url("admin/index") ?>');
							} else {
								window.location.replace('<?= site_url("user/index") ?>');	
							}
						}, 1500 );
						
					} else {
						$('#result').text($data.text);
						$('#result').attr('class','alert alert-danger');
					}
				},
				error: ($jhr,$status,$error) => {
					console.log($jhr,$status,$error);
				}
			});
			return false;
		});

		// $("#register-form").submit(function(){
		// 	var _formData = $(this).serialize();
		// 	$.ajax({
		// 		url:'<?= site_url('login_wpa/ajax_register_process')?>',
		// 		data: _formData,
		// 		type:'post',
		// 		dataType:'json',
		// 		success: ($data) => {
		// 			console.log($data);

		// 			if ($data.status) {
		// 				$('#reg-result').text($data.text);
		// 				$('#reg-result').attr('class','alert alert-success');
						
		// 			} else {
		// 				$('#reg-result').text($data.text);
		// 				$('#reg-result').attr('class','alert alert-danger');
		// 			}
		// 		},
		// 		error: ($jhr,$status,$error) => {
		// 			console.log($jhr,$status,$error);
		// 		}
		// 	});
		// 	return false;
		// });

		$("#show-register-modal").click(function(){
			$('#reg-result').text('');
			$('#reg-result').attr('class','');
			$('#register-form').find("input[name='course']").val('');
			$('#register-form').find("input[name='title']").val('');
			$('#register-form').find("input[name='first_name']").val('');
			$('#register-form').find("input[name='last_name']").val('');
			$('#register-form').find("input[name='user']").val('');
			$('#register-form').find("input[name='password']").val('');
			$('#register-form').find("input[name='student_id']").val('');
			$('#register-form').find("input[name='tel_num']").val('');
			$("#register-modal").modal();
		});
	});
</script>