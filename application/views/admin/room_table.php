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
                    <li><a href="" id="editBtn" data-id="<?php echo $row['room_id']?>" data-name="<?php echo $row['name']?>" data-toggle="modal" data-target="#edit-modal">Edit</a></li>
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

<div class="modal fade" id="edit-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Room</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label>Room Name</label>
                        <input type="text" name='name' required class="form-control" id="name" />
                    </div>
                    <div class="form-group m-b-0">
                        <button type="submit" class="btn btn-inverse btn-custom" name='cmd' value='Save'>Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-inverse btn-custom" name='cmd' value='Save'>Save</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
            $('#example3').DataTable({
            'ordering': false,
            'dom' : 'frtlp'
        });
    });
</script>