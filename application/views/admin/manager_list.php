<div class="col-xs-12">
	<h3 class="m-t-0 m-b-20 header-title">Managers</h3>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">List Managers</a></li>
    <li><a data-toggle="tab" href="#add">Assign to Building</a></li>
</ul>
<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
            <div class="col-xs-12">
                <div class="table-responsive">
                	<?php if($this->session->flashdata('error')): ?>
	                    <div style='color: red; margin: 0 0 20px 0; border: solid 1px #f0a8b5; background: rgba(230,117,136,0.15); padding: 10px; border-radius: 5px'>
	                    	<?php echo $this->session->flashdata('error')?>
	                    </div>
	                <?php endif;?>
                	<table id="example3" class="table table-bordered table-hover">
                		<thead>
                			<tr>
                				<th>Image</th>
                				<th>ID</th>
                				<th>Manager Name</th>
                				<th>Email</th>
                				<th>Position</th>
                				<th>Assigned to #</th>
                				<th>Status</th>
                				<th>Created</th>
                				<th>Actions</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                			if (isset($managers) && is_array($managers))
                			{
                				foreach ($managers as $key => $row):
                					?>
                					<tr>
                						<td><img style="max-width: 70px;max-height:70px;border-radius:5px" src="<?= $row['avatar']?>"/></td>
                						<td><?php echo $row['admin_id'] ?></td>
                						<td><?php echo $row['full_name']?></td>
                						<td><?php echo $row['email']?></td>
                						<td><?php echo $row['position_name']?></td>
                						<td><?php echo ($row['building_name'] != null) ? $row['building_name'] : 'N/A' ?></td>
                						<td><?php echo $row['status'] == 0 ? '' : 'Verified'?></td>
                						<td><?php echo date('d/m/Y h:iA', $row['created'])?></td>
                						<td>
                							<div class="dropdown">
                								<span class="btnAction dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i></span>
                								<ul class="dropdown-menu" id="customDropdown">
                									<li><a href="">Edit</a></li>
                									<li><a href="">Verify</a></li>
                									<li><a href="">Delete</a></li>
                								</ul>
                							</div>
                						</td>
                					</tr>
                					<?php 
                				endforeach;
                			}
                			?>
                		</tbody>
                	</table>
                </div>
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
                        		<label>Choose Manager</label>                        
                        		<select class="major_id form-control" name="manager_id" required="">
                        			<option value="">Select Manager</option>
                        			<?php foreach($managerOthers as $manager):?>
                        				<option value="<?php echo $manager['admin_id']?>"><?php echo $manager['full_name']?></option>
                        			<?php endforeach; ?>
                        		</select>                    
                        	</div>
                        	<div class="form-group">   
                        		<label>Choose Building</label>                        
                        		<select class="course_id form-control" name="building_id" required="">
                        			<option value="">Select Building</option>
                        			<?php foreach($buildings as $building):?>
				        				<option value="<?php echo $building['building_id']?>"><?php echo $building['name']?></option>
				        			<?php endforeach; ?>
                        		</select>                    
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
