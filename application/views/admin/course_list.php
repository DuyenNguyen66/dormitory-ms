<div class="col-xs-12">
	<h3 class="m-t-0 m-b-20 header-title">Courses</h3>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">List Courses</a></li>
    <li><a data-toggle="tab" href="#add">Add Course</a></li>
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
                				<th>Abbreviations Name</th>
                				<th>Full Name</th>
                                <th>Total Class</th>
                				<th>Actions</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                			if (isset($courses) && is_array($courses))
                			{
                				foreach ($courses as $key => $row):
                					?>
                					<tr>
                						<td><?php echo $row['course_id'] ?></td>
                						<td><?php echo $row['abb_name'] ?></td>
                						<td><?php echo $row['full_name']?></td>
                                        <td><?php echo $row['total_class']?></td>
                						<td>
                							<div class="dropdown">
                								<span class="btnAction dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i></span>
                								<ul class="dropdown-menu" id="customDropdown">
                									<li><a href="">Edit</a></li>
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
                                <label>Abbreviations Name</label>                        
                                <input type="text" name='abb_name' required class="form-control" placeholder="Type name" />
                            </div>
                            <div class="form-group">                       
                                <label>Full Name</label>                        
                                <input type="text" name='full_name' required class="form-control" placeholder="Type name" />
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
