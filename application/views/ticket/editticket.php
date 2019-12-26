<nav aria-label="breadcrumb" class="breadcrumb-nav">
   	<div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ti-ticket"></i> Tickets</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="clients.html">Tickets</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
    </div>
</nav>
<!-- contetn-wrap -->
<div class="content-in">
	<form id="editticket" class="aj-form" method="post" action="<?php echo base_url().'ticket/editticket/'.base64_encode($editticketId); ?>">  
		<?php
	        $mess = $this->session->flashdata('message_name');
	        if(!empty($mess)){
	                //warning 
	    ?>
		<div class="submit-alerts">
			<div class="alert alert-success" role="alert" style="display:block;">
			</div>
	    </div>
	    <div class="submit-alerts">
			<div class="alert alert-danger" role="alert" style="display:block;">
			 <?php echo $mess; ?>
			</div>
	    </div>
	    <?php  } ?>
	    <div class="submit-alerts">
			<div class="alert alert-warning" role="alert">
			  This is a warning alert
			</div>
		</div>
                            
		<div class="form-body">
            <div class="row">
                <div class="col-md-8">
	                <div class="card br-0">
	                	<div class="card-header br-0 text-right text-black">
	                		Ticket # 31
	                	</div>
	                	<div class="card-wrapper collapse show">
	                		<div class="card-body">
                				<div class="submit-alerts">
                					<div class="alert alert-success" role="alert">
									  This is a success alert
									</div>
									<div class="alert alert-danger" role="alert">
									  This is a danger alert
									</div>
									<div class="alert alert-warning" role="alert">
									  This is a warning alert
									</div>
                				</div>
                				<div class="form-body">
                					<div class="row">
                						<div class="col-md-12">
                							<div class="form-group" id="comment_for_ticket">
                								<label class="control-label">
                							<?php
                								 echo 'Ticket Subject='.$ticketinfo[0]->ticketsubject;
                								 echo '<br/><br/>';
                								 echo $ticketinfo[0]->created_at;
                								
                							 ?>
                							  </label>
                							</div>
                						</div>
                					</div>
                					<div class="row">
                						<div class="col-md-12">
                							<div class="table-responsive">
												<table class="table">
													<thead id="thead">
													<tr>
														<th>#</th>
														<th>Image</th>
														<th>Created at</th>
														<th>Requester</th>
														<th></th>
													</tr>
													</thead>
													 <tbody id="replaytable">
															<?php 	
															 $i=1;
																foreach($ticketcomment as $tcomm) { ?>      
																    <tr>
																		<td><?php echo $i; ?></td>
																		<td></td>
																		<td><?php echo $tcomm->comment; ?></td>
																		<td><?php echo $tcomm->created_at; ?></td>
																		<td>
																			<!-- <a href="javascript:void(0);" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deletecomment('<?php echo $tcomm->id; ?>')" id='deletecat'>Remove</a> -->
																			<input type='button' class='btn btn-sm btn-danger btn-rounded delete-category' onclick ="delete_t_comment('<?php echo $tcomm->id; ?>');" id='deletereply' value='Remove'>
																		</td>
																	<!-- 	<td id="delete"><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" id="deletebtn">Remove</a></td> -->
																    </tr>
														   <?php $i++; } ?>
													</tbody>
												</table>
											</div>
                						</div>
                					</div>
                					<div id="append"></div>
									<div class="row">
                                		<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Ticket Description <span class="text-danger">*</span></label>
                                               <textarea name="editor" id="editor" ></textarea> 
                                                
                                              
                                            </div>
                                        </div>
                        			</div>
                        			<div class="row">
		                    			<div class="col-md-6">
		            						<div class="form-group type">
		            							<label>Status <span class="text-danger">*</span></label>
		            							<select class="custom-select br-0" name="status" id="status">
		            							<!-- 	<option selected value="0">Open</option>
		            								<option value="1">Pending</option>
		            								<option value="2">Resolved</option>
		            								<option value="3">Close</option> -->
		            							<option value="0" <?php if($ticketinfo[0]->status=='0'){echo 'selected';}?>>Open</option>
		            							<option value="1" <?php if($ticketinfo[0]->status=='1'){echo 'selected';}?>>Pending</option>
		            							<option value="2" <?php if($ticketinfo[0]->status=='2'){echo 'selected';}?>>Resolved</option>
		            							<option value="3" <?php if($ticketinfo[0]->status=='3'){echo 'selected';}?>>Close</option>

		            							</select>
		            						</div>
		            					</div>
	            					</div>
                        		<!-- 	<div class="row">
                                		<div class="col-md-12">
                                            <div class="form-group">
                                            	<label class="control-label">Ticket Image 
                                            	</label><br/>
                                                 	<input type='file'class="file-upload-input" name="ticket_Image" id="ticket_Image"/>
                                                 	<input type="hidden" name="hidden_img" value="<?php echo !empty($ticketinfo[0]->ticketimage) ? $ticketinfo[0]->ticketimage : '' ?>" >
                                             
                                            </div>
                                        </div>
                        			</div> -->
                				</div>
	                		</div>
	                		<div class="card-footer text-right">
	                			<!-- action btn -->
                                <div class="form-actions">
	                                <div class="btn-group">
									  	<!-- <button type="submit" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="submitticket">
									    	Submit
									  	</button> -->
									  	<button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" name="submitticket" id="submitticket">
									    	Submit
									  	</button> 
									  <!-- 	<div class="dropdown-menu">
										    <a class="dropdown-item" href="#">Submit Open <span style="width: 15px; height: 15px;" class="btn btn-danger btn-small btn-circle">&nbsp;</span></a>
										    <a class="dropdown-item" href="#">Submit Pending <span style="width: 15px; height: 15px;" class="btn btn-warning btn-small btn-circle">&nbsp;</span></a>
										    <a class="dropdown-item" href="#">Submit Resolved <span style="width: 15px; height: 15px;" class="btn btn-info btn-small btn-circle">&nbsp;</span></a>
										    <a class="dropdown-item" href="#">Submit Close <span style="width: 15px; height: 15px;" class="btn btn-success btn-small btn-circle">&nbsp;</span></a>
									  	</div> -->
									</div>
	                            </div>
	                		</div>

	                	</div>
	                </div>
	            </div>
	            <!-- <div class="col-md-4">
	            	<div class="card br-0">
	            		<div class="card-wrapper collapse show">
	            			<div class="card-body">
	            				<div class="row">
	            					<div class="col-md-12">
	            						<div class="form-group">
	            							<label class="control-label">Requester Name</label>
	            							<select class="custom-select br-0" name="requestername" id="requestername">
	            								<option selected>Select Requester Name</option>
	            								<option>Kethi Oman[kethi@example.com]</option>
	            								<option>Obama Donald[donald77@example.com]</option>
	            								<option>Jequcy Trump[jequcy@example.com]</option>
	            								<option>herry Oman[Oman@example.com]</option>
	            								<option>Obama champ[Obama@example.com]</option>
	            								<option>maxo Trump[Trump@example.com]</option>
	            							</select>
	            						</div> 
	            					</div>
	            					<div class="col-md-12">
	            						<div class="form-group">
	            							<label class="control-label">Agent</label>
	            							<select class="custom-select br-0" name="agentname" id="agentname">
	            								<option selected>Agent not assigned</option>
	            								<option>Kethi Oman[kethi@example.com]</option>
	            								<option>Obama Donald[donald77@example.com]</option>
	            								<option>Jequcy Trump[jequcy@example.com]</option>
	            								<option>herry Oman[Oman@example.com]</option>
	            								<option>Obama champ[Obama@example.com]</option>
	            								<option>maxo Trump[Trump@example.com]</option>
	            							</select>
	            						</div>
	            					</div>

	            					<div class="col-md-6">
	            						<div class="form-group type">
	            						<label class="control-label">Add Type</label>
	            							<select class="custom-select br-0" name="question" id="question">
	            								<?php
	            							foreach($tickettype as $ticket){
												$str='';
												if($ticket->id==$ticketinfo[0]->type){
												//echo $ticket->id.'<br/>';
												//echo $ticketinfo[0]->type;die;	
													$str='selected';
												}
												
													echo '<option value="'.$ticket->id.'"'.$str.'>'.$ticket->name.'</option>';
											}
										?>

											</select>
	            						</div>
	            					</div>

	            					<div class="col-md-6">
	            						<div class="form-group type">
	            							<label>Priority <span class="text-danger">*</span></label>
	            							<select class="custom-select br-0" name="priority" id="priority">
	            								<option value="0">Low</option>
	            								<option value="1">High</option>
	            								<option value="2">Medium</option>
	            								<option value="3">Urgent</option>
	            							</select>
	            						</div>
	            					</div>
	            					
	            					<div class="col-md-12">
	            						<div class="form-group channel">
	            							<label class="control-label">Channel Name </label>
	            							<select class="custom-select br-0" name="channel" id="channel">
	            								<?php
	            								foreach($ticketchannel as $tchannel){
														$str='';
															if($tchannel->id == $ticketinfo[0]->channelname){	 
																//echo($tchannel->id);
																//echo($ticketinfo[0]->channelname);
																//die;
																$str='selected';
															}
															echo '<option value="'.$tchannel->id.'"'.$str.'>'.$tchannel->name.'</option>';
											}
												/*foreach($ticketchannel as $channel){
							            		echo '<option value="'.$channel->id.'">
							            		'.$channel->name.'</option>';
							            	}*/
										?>
										</select>
	            					</div>
	            					</div>
	            					 <div class="col-md-12">
	            						<div class="form-group">
	            							<label class="control-label">Tags</label>
	            							<input type="text" id="tags" class="form-control" name="tags" value="<?php echo !empty($ticketinfo[0]->tags) ? $ticketinfo[0]->tags : '' ?>">
	            						</div>
	            					</div> 
	            				    
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>  -->
            </div>
        </div>
    </form>
</div>	
<!-- ends of contentwrap -->

