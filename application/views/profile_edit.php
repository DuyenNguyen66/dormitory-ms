<div class="col-xs-12" style="margin: 20px 0">
    <h3 class="header-title">Cập nhật thông tin</h3>
</div>
<div class="row card-box"> 
    <div class="tab-content">
       	<form class="login100-form validate-form"  action='' method='POST' enctype="multipart/form-data">
                <div class="row">
	                <div class="col-md-6 form-group">
	                	<label>Fullname</label>
	                    <input class="form-control" type="text" name="name" value="<?php echo $student['full_name']?>" required>
	                </div>
	                <div class="col-md-6 form-group">
	                	<label>Student Code</label>
	                    <input class="form-control" type="text" name="code" value="<?php echo $student['student_code']?>" required>
	                </div>
                </div>
                <div class="row">
                	<div class="col-md-6 form-group">
	                	<label>Email</label>
	                    <input class="form-control" type="text" name="email" value="<?php echo $student['email']?>" required>
	                </div>
	               
	            </div>
	            <div class="row">
	                <div class="col-md-6 form-group">
	                	<label>Phone number</label>
	                    <input class="form-control" type="text" name="phone" value="<?php echo $student['phone']?>" required>
	                </div>
	                <div class="col-md-6 form-group">
	                	<label>Address</label>
	                    <input class="form-control" type="text" name="address" value="<?php echo $student['address']?>" required>
	                </div>
	            </div>
                <div class="row">
                	<div class="col-md-6 form-group">
	                	<label>Gender</label>
	                	<div class="col-md-12">
	                		<input type="radio" name="gender" value="1" <?php echo $student['gender'] == 1 ? 'checked' : ''?>>&nbsp;Male&nbsp;&nbsp;&nbsp;
	                		<input type="radio" name="gender" value="0" <?php echo $student['gender'] == 0 ? 'checked' : ''?>>&nbsp;Female
	                	</div>
	                </div>
	                <div class="col-md-6 form-group">
	                	<label>Birthday</label>
	                    <input class="form-control" type="date" name="birthday" value="<?php echo $student['birthday']?>" required>
	                </div>
	               
	            </div>
                <div class="row">
                	<div class="col-md-6 form-group">
	                	<label>Ethnic</label>
	                	<select class="form-control" name="ethnic_id" required="">
	                		<option value="<?php echo $student['ethnic_id']?>"><?php echo $student['ethnic_name']?>"</option>
	                		<?php foreach($ethnics as $ethnics):?>
	                		<option value="<?php echo $ethnic['ethnic_id'] ?>"><?php echo $ethnic['name'] ?></option>
	                		<?php endforeach;?>
	                	</select>
	                </div>
	                <div class="col-md-6 form-group">
	                	<label>Religion</label>
	                	<select class="form-control" name="religion_id" required="">
	                		<option value="<?php echo $student['religion_id']?>""><?php echo $student['religion_name']?>"</option>
	                		<?php foreach($religions as $religion):?>
	                		<option value="<?php echo $religion['religion_id'] ?>"><?php echo $religion['name'] ?></option>
	                		<?php endforeach;?>
	                	</select>
	                </div>
	            </div>
                <div class=" form-group">
                	<label class="col-md-12">Student Card</label>
                	<div class="col-md-6">
                		<div class="" onclick="$('#imagePhoto').click()">
                			<input type="file" accept="image/*" name="image" id="imagePhoto" required value="<?php echo base_url($student['student_card'])?>" />
                		</div>
                	</div>
                	<div class="col-md-6">
                		<img id='image' width='300' height='200' style='border: 4px solid #c6c6c6; border-radius: 4px'/>
                	</div>
	            </div>
            </form>
    </div>
</div>
