<table id="example3" class="table">
    <!-- <thead></thead> -->
    <tbody>
     <?php
     if (isset($rooms) && is_array($rooms))
     {
        foreach ($rooms as $key => $row):
            if($row['total_student'] < 5) {
        ?>
            <div class="room">
                <a href="<?php echo base_url('registerRoom/' . $row['room_id'])?>">
                    <h4><?php echo $row['name']?></h4>
                    <h4><?php echo $row['total_student']?>/10</h4>
                </a>
            </div>
        <?php 
            }else if($row['total_student'] <= 5 && $row['total_student'] < 10) {
        ?>
            <div class="room1">
                <a href="<?php echo base_url('registerRoom/' . $row['room_id'])?>">
                    <h4><?php echo $row['name']?></h4>
                    <h4><?php echo $row['total_student']?>/10</h4>
                </a>
            </div>
        <?php
            }else {
        ?>
            <div class="room2">
                <a href="<?php echo base_url('registerRoom/' . $row['room_id'])?>">
                    <h4><?php echo $row['name']?></h4>
                    <h4><?php echo $row['total_student']?>/10</h4>
                </a>
            </div>
        <?php
            }
        endforeach;
    }
    ?>
    </tbody>
</table>

<!-- <script type="text/javascript">
    $(document).ready(function(){
            $('#example3').DataTable({
            'ordering': false,
            'dom' : 'frtlp'
        });
    });
</script> -->