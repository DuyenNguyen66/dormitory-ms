<div class="col-xs-12">
	<h3 class="m-t-0 m-b-20 header-title">Buildings</h3>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">List Managers</a></li>
    <li><a data-toggle="tab" href="#addBuilding">Add Manager</a></li>
</ul>
<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
            <div class="col-xs-12">
                <div class="table-responsive">
                	<table id="example3" class="table table-bordered table-hover">
                		<thead>
                			<tr>
                				<th>ID</th>
                				<th>Building Name</th>
                				<th>Image</th>
                				<th>Number of Floors</th>
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
                						<td><?php echo $row['building_id'] ?></td>
                						<td><?php echo $row['name']?></td>
                						<td><img style="max-width: 70px;max-height:70px;border-radius:5px" src="<?= $row['image']?>"/></td>
                						<td><?php echo $row['total_floors'] ?></td>
                						<td>
                							<div class="dropdown">
                								<span class="btnAction dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i></span>
                								<ul class="dropdown-menu" id="customDropdown">
                									<li><a href="<?php echo base_url('building/edit/' . $row['building_id'])?>">Edit</a></li>
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
                	<script type="text/javascript">
                		$(document).ready(function(){
                			$('#example3').DataTable({
                				'ordering': false,
                				'dom' : 'frtilp',
                				'searching': false
                			});
                		});
                	</script>

                </div>
            </div>
        </div>
        <div id="addBuilding" class="tab-pane fade">             
            <form action='' method='POST' enctype="multipart/form-data">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6 card-box">
                        <!-- general form elements -->
                        <div class="box-body">
                            <div class="form-group">                       
                                <label>Name</label>                        
                                <input type="text" name='name_building' required class="form-control" placeholder="Type building name" />
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-12">Image</label>
                                <div class="col-md-4">
                                    <img id='image' width='120' height='120' style='border: 4px solid #c6c6c6; border-radius: 4px'/>
                                </div>
                                <div class="col-md-8">
                                    <div class="" onclick="$('#imagePhoto').click()">
                                        <input type="file" accept="image/*" name="image" id="imagePhoto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <button type="submit" class="btn btn-inverse btn-custom" name='cmd1' value='Save'>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="addFloor" class="tab-pane fade">             
            <form action='' method='POST' enctype="multipart/form-data">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6 card-box">
                        <!-- general form elements -->
                        <div class="box-body">
                            <div class="form-group">   
                                <label>Building</label>                        
                            	<select name="building_id" class="form-control">
                            		<option value="">Select Building</option>
                            		<?php foreach($buildings as $building):?>
                            		<option value="<?php echo $building['building_id']?>"><?php echo $building['name']?></option>
	                            	<?php endforeach; ?>
                            	</select>                    
                            </div>
                            <div class="form-group">                       
                                <label>Name</label>                        
                                <input type="text" name='name_floor' required class="form-control" placeholder="Type floor name" />
                            </div>
                            <div class="form-group m-b-0">
                                <button type="submit" class="btn btn-inverse btn-custom" name='cmd2' value='Save'>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
