<div class="modal fade project-category" id="commonleave" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Approved Leaves Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<td>Casual</td>
							<td>Sick</td>
							<td>Earned</td>
						</tr>
						<tr>
							<th>#</th>
							<th>Leave Type</th>
							<th>Date</th>
							<th>Reason For Absence</th>
						</tr>
						</thead>
						 <tbody>
							<!-- 	<?php foreach ($category as $row) { ?>      
									  <tr id="cate_<?php echo $row->id;?>">
										  <td><?php echo $row->id; ?></td>
										  <td><?php echo $row->name; ?></td>
										  <td><a href="javascript:void(0);" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deletecat('<?php echo $row->id; ?>')" id='deletecat'>Remove</a></td>
									  </tr>
							   <?php } ?> -->
						</tbody>
					</table>
				</div>
				<hr>
				
			</div>
		</div>
	</div>
</div>
