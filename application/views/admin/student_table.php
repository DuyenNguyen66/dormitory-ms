<table id="example3" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Student code</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
<tbody>
 <?php
 if (isset($students) && is_array($students))
 {
    foreach ($students as $key => $row):
       ?>
       <tr>
            <td><?php echo $row['student_id'] ?></td>
            <td><?php echo $row['full_name']?></td>
            <td><?php echo $row['student_code']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['phone']?></td>
            <td><?php echo $row['status'] == 0 ? '<a class="btn btn-warning btn-xs">Disabled</a>' : '<a class="btn btn-success btn-xs">Enabled</a>' ?></td>
            <td>
            <div class="dropdown">
                <span class="btnAction dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i></span>
                <ul class="dropdown-menu" id="customDropdown">
                    <li><a href="<?php echo base_url('profile/'. $row['student_id'])?>">View Profile</a></li>
                    <?php if($row['status'] == 0 ): ?>
                    <li><a href="">Verify</a></li>
                    <?php else:?>
                    <li><a href="">Disable</a></li>
                    <?php endif;?>
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
        'dom' : 'frtlp'
    });
 });
</script>