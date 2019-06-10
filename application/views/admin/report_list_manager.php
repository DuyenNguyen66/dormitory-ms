<div class="col-xs-12" style="margin: 20px 0">
    <h3 class=" header-title">Reports</h3>
    <div style="margin: 3rem 0 0 2rem;">
        <form action="" method="post">
            <input type="submit" name="cmd" value="Send Report" class="btn btn-inverse btn-custom">
        </form>
    </div>
</div>
<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
            <div class="col-xs-12">
                <div class="table-responsive">
                	<table id="example4" class="table table-hover">
                		<thead>
                			<tr>
                                <th>ID</th>
                                <th>Tháng</th>
                                <th>Kỳ</th>
                                <th>Số hóa đơn đã thanh toán</th>
                                <th>Số hóa đơn chưa thanh toán</th>
                                <th>Tổng thu dự tính</th>
                                <th>Tổng thu thực tế</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                			if (isset($reports) && is_array($reports))
                			{
                				foreach ($reports as $key => $row):
                					?>
                					<tr>
                                        <td><?php echo $row['report_id'] ?></td>
                                        <td><?php echo $row['month']?></td>
                                        <td><?php echo $row['term_name']?></td>
                                        <td><?php echo $row['num_paid']?></td>
                                        <td><?php echo $row['num_not_paid']?></td>
                                        <td><?php echo $row['expected_total']?></td>
                                        <td><?php echo $row['actual_total']?></td>
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
