<div class="col-xs-12">
	<h3 class="m-t-0 m-b-20 header-title">Room Bills</h3>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">Bills List</a></li>
    <li><a data-toggle="tab" href="#add">Add bill</a></li>
</ul>
<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
            <div class="col-xs-12">
                <div class="table-responsive">
                	<table id="example4" class="table table-hover">
                		<thead>
                			<tr>
                                <th>ID</th>
                                <th>Phòng</th>
                				<th>Kỳ</th>
                                <th>Hạn thanh toán</th>
                				<th>Ngày thanh toán</th>
                                <th>Trạng thái</th>
                				<th>Actions</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                			if (isset($bills) && is_array($bills))
                			{
                				foreach ($bills as $key => $row):
                					?>
                					<tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['room_name']?></td>
                                        <td><?php echo $row['term_name']?></td>
                                        <td><?php echo date('d/m/Y', $row['deadline'])?></td>
                                        <td>
                                            <?php if($row['paid'] == 0):?>
                                            <button class="btn btn-xs btn-danger">Chưa thanh toán</button>
                                            <?php else: 
                                                echo date('d/m/Y h:i:s', $row['paid']);
                                            endif; ?>
                                        </td>
                                        <td><?php echo $row['status'] == 0 ? '<a class="btn btn-warning btn-xs">Disabled</a>' : '<a class="btn btn-success btn-xs">Enabled</a>' ?></td>
                						<td>
                                            <?php if($row['paid'] == 0): ?>
                                            <button type="button" class="btn btn-inverse btn-custom btn-xs">
                                                <a href="<?php echo base_url('bill/paid2/' . $row['id'])?>">Đã thanh toán</a>
                                            </button>
                                            <?php else: ?>
                                            <button type="button" class="btn btn-inverse btn-custom btn-xs">
                                                <a href="<?php echo base_url('bill/disable2/' . $row['id'])?>">Disable</a>
                                            </button>
                                            <?php endif;?>
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
                    <div class="card-box">
                        <!-- general form elements -->
                        <div class="row box-body">
                            <div class="col-md-7">
                                <div class="form-group">   
                                	<label>Chọn phòng</label>                        
                                	<select class="room_id form-control" name="room_id" required="">
                                		<option value="">Chọn phòng</option>
                                		<?php foreach($rooms as $room):?>
                                			<option value="<?php echo $room['room_id']?>"><?php echo $room['name']?></option>
                                		<?php endforeach; ?>
                                	</select>                    
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group"> 
	                                <label>Hạn thanh toán</label>  
                                	<input type="date" name="date" required class="form-control">               
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <button type="submit" class="btn btn-inverse btn-custom" name='cmd' value='Save'>Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
