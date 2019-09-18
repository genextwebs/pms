<div class="row">
	<div class="col-lg-3 col-md-4">
		<div class="form-group">
			<label class="control-label">Projects Status</label>
			<select id="project_status" class="custom-select" name="project_status">
				<option value='all'>All</option>          
				<option value='1'>Complete</option>  
				<option value='0'>Incomplete</option>   
			</select> 
		</div>
	</div>
	<div class="col-lg-3 col-md-4">
		<div class="form-group">
			<label class="control-label">Client Name</label>
			<select id="clientname" class="custom-select" name="clientname">
				<option value="">--Select--</option>
					<?php
						foreach($client as $row)
						{
							echo '<option value="'.$row->id.'" >'.$row->clientname.'</option>';
						}
					?>
			</select>
		</div>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="archievdata" name="archievdata">
		<thead>
			<tr role="row">
				 <th>Id</th>
				 <th>Project Name</th>
				 <th>Project Members</th>
				 <th>Deadline</th>
				 <th>Client</th>
				 <th>Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
	