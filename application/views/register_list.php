<div class="col-xs-12" style="margin: 20px 0">
	<h3 class="header-title">Register History</h3>
</div>

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
                				<th>Room</th>
                				<th>Floor</th>
                				<th>Building</th>
                				<th>Registed</th>
                				<th>Confirmed</th>
                				<th>Status</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                			if (isset($histories) && is_array($histories))
                			{
                				foreach ($histories as $key => $row):
                					?>
                					<tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['term_name']?></td>
                                        <td><?php echo $row['room_name']?></td>
                                        <td><?php echo $row['floor_name']?></td>
                                        <td><?php echo $row['build_name']?></td>
                						<td><?php echo date('d/m/Y h:iA', $row['registed']) ?></td>
                						<td><?php echo $row['confirmed'] == null ? '<button class="btn btn-warning">Not confirmed yet</button>' : date('d/m/Y h:iA', $row['confirmed']) ?></td>
                						<td><?php echo $row['status'] == 0 ? '<button class="btn btn-warning">Inactive</button>' : '<button class="btn btn-success">Active</button>' ?></td>
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
