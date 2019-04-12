<table id="example3" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Room Name</th>
            <th>Number of Students</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
     <?php
     if (isset($rooms) && is_array($rooms))
     {
        foreach ($rooms as $key => $row):
        ?>
        <tr>
            <td><?php echo $row['room_id'] ?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['total_student']?></td>
            <td>
            <div class="dropdown">
                <span class="btnAction dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i></span>
                <ul class="dropdown-menu" id="customDropdown">
                    <li><a href="<?php echo base_url('room/assignment/' . $row['room_id'])?>">Add Student</a></li>
                    <li><a href="">Edit</a></li>
                    <li><a href="">View Students</a></li>
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