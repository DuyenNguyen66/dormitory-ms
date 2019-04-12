<div class="col-xs-12">
	<h3 class="m-t-0 m-b-20 header-title">Students</h3>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#list">List Students</a></li>
</ul>
<div class="row card-box"> 
    <div class="tab-content">
        <div id="list" class="tab-pane fade in active">
        	<div class="statusSelect col-md-6 form-group">   
        		<label>Status</label>                        
        		<select class="status form-control" >
                    <option value="2" selected>All</option>
                    <option value="1">Verified Students</option>
                    <option value="0">Unverified Students</option>
        		</select>                    
        	</div>
            <div class="col-xs-12">
                <div class="table-responsive" id="student_table"></div>
            </div>
        </div>
        <div id="add" class="tab-pane fade in active">
            
        </div>
    </div>
</div>
