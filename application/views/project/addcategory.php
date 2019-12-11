<div class="modal fade project-category" id="project-category1" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Project Category</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>#</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
						</thead>
						 <tbody>
								<?php foreach ($category as $row) { ?>      
									  <tr>
										  <td><?php echo $row->id; ?></td>
										  <td><?php echo $row->name; ?></td>
										  <td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" id='deletecat'>Remove</a></td>
									  </tr>
							   <?php } ?>
						</tbody>
					</table>
				</div>
				<hr>
				<form id="category" class="" id="category" name="category" method="post" onsubmit="return checkName();">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Leave Type</label>
									<input type="text" name="category_name" id="category_name" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" id="save-category" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
