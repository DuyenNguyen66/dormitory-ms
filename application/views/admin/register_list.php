<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
            <div class="col-xs-12">
                <div class="table-responsive">
                	<table id="example3" class="table table-bordered table-hover">
                		<thead>
                			<tr>
                                <th>ID</th>
                                <th>Term</th>
                                <th>Student</th>
                                <th>Code</th>
                				<th>Room</th>
                				<th>Floor</th>
                				<th>Building</th>
                				<th>Registed</th>
                				<th>Confirmed</th>
                				<th>Status</th>
                				<th>Actions</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                			if (isset($forms) && is_array($forms))
                			{
                				foreach ($forms as $key => $row):
                					?>
                					<tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['term_name']?></td>
                                        <td><?php echo $row['full_name']?></td>
                                        <td><?php echo $row['student_code']?></td>
                                        <td><?php echo $row['room_name']?></td>
                                        <td><?php echo $row['floor_name']?></td>
                                        <td><?php echo $row['build_name']?></td>
                						<td><?php echo date('d/m/Y h:iA', $row['registed']) ?></td>
                						<td><?php echo $row['confirmed'] == null ? '<button class="btn btn-warning">Not confirmed yet</button>' : date('d/m/Y h:iA', $row['confirmed']) ?></td>
                						<td><?php echo $row['status'] == 0 ? '<button class="btn btn-warning">Inactive</button>' : '<button class="btn btn-success">Active</button>' ?></td>
                						<td>
                							<div class="dropdown">
                								<span class="btnAction dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i></span>
                								<ul class="dropdown-menu" id="customDropdown">
                									<?php if($row['status'] == 0 && $row['confirmed'] == null): ?>
                									<li><a href="<?php echo base_url('register/confirm/' . $row['id'])?>">Confirm</a></li>
                									<?php else: ?>
                									<li><a href="<?php echo base_url('register/disable/' . $row['id'])?>">Disable</a></li>
	                								<?php endif; ?>
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
    </div>
</div>
