<div class="col-xs-12">
	<h3 class="m-t-0 m-b-20 header-title">Classes</h3>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">List Classes</a></li>
    <li><a data-toggle="tab" href="#add">Add Class</a></li>
</ul>
<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
        	<div class="col-md-6 form-group">   
        		<label>Choose Major</label>                        
        		<select class="major_id form-control" >
                    <option value="">Select Major</option>
        			<option value="0">All Major</option>
        			<?php foreach($majors as $major):?>
        				<option value="<?php echo $major['major_id']?>"><?php echo $major['abb_name']?> - <?php echo $major['full_name']?></option>
        			<?php endforeach; ?>
        		</select>                    
        	</div>
        	<div class="col-md-6 form-group">   
        		<label>Choose Course</label>                        
        		<select class="course_id form-control" >
                    <option value="">Select Course</option>
					<option value="0">All Course</option>
					<?php foreach($courses as $course):?>
        				<option value="<?php echo $course['course_id']?>"><?php echo $course['abb_name']?> - <?php echo $course['full_name']?></option>
        			<?php endforeach; ?>
        		</select>                    
        	</div>
            <div class="col-xs-12">
                <div class="table-responsive" id="class_table"></div>
            </div>
        </div>
        <div id="add" class="tab-pane fade">             
            <form action='' method='POST' enctype="multipart/form-data">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6 card-box">
                        <!-- general form elements -->
                        <div class="box-body">
                        	<div class="form-group">   
                        		<label>Choose Major</label>                        
                        		<select class="major_id form-control" name="major_id" required="">
                        			<option value="">Select Major</option>
                        			<?php foreach($majors as $major):?>
                        				<option value="<?php echo $major['major_id']?>"><?php echo $major['abb_name']?> - <?php echo $major['full_name']?></option>
                        			<?php endforeach; ?>
                        		</select>                    
                        	</div>
                        	<div class="form-group">   
                        		<label>Choose Course</label>                        
                        		<select class="course_id form-control" name="course_id" required="">
                        			<option value="">Select Course</option>
                        			<?php foreach($courses as $course):?>
				        				<option value="<?php echo $course['course_id']?>"><?php echo $course['abb_name']?> - <?php echo $course['full_name']?></option>
				        			<?php endforeach; ?>
                        		</select>                    
                        	</div>
                        	<div class="form-group">
                        		<label>Class Name</label>
                                <input type="text" name='name' required class="form-control" placeholder="Type class name..." />
                        	</div>
                            
                            <div class="form-group m-b-0">
                                <button type="submit" class="btn btn-inverse btn-custom" name='cmd' value='Save'>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
