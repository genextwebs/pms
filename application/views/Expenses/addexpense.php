<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-receipt"></i>Expenses</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Finance'?>">Expenses</a></li>
                            <li class="active">Add New</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
		                <div class="card br-0">
		                	<div class="card-header br-0 card-header-inverse">
								ADD Expenses
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form class="aj-form" method="post" action="<?php echo base_url().'Finance/createinvoice' ?>" name="createinvoice" >
											 <?php
												$mess = $this->session->flashdata('message_name');
												if(!empty($mess)){
													//warning 
											?>
            				
										<div class="submit-alerts">
		                					<div class="alert alert-success" role="alert" style="display:block;">
											
											  This is a success alert
											</div>
										</div>
										<div class="submit-alerts">
											<div class="alert alert-danger" role="alert" style="display:block;">
												<?php echo $mess; ?>
											</div>
										</div>
												<?php } ?>
									
										<div class="submit-alerts">
											<div class="alert alert-warning" role="alert">
											  This is a warning alert
											</div>
		                				</div>
		                				<div class="form-body">
		                					<div class="row">
											<div class="col-md-12 ">
                                    <div class="form-group">
                                        <label>Choose Member</label>
                                        <div class="select2-container select2 form-control" id="s2id_user_id"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-1">Mr. Harley Macejkovic DVM</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen1" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-1" id="s2id_autogen1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen1_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-1" id="s2id_autogen1_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-1">   </ul></div></div><select id="user_id" class="select2 form-control" data-placeholder="Choose Member" name="user_id" tabindex="-1" title="" style="display: none;">
                                                                                            <option value="1">Mr. Harley Macejkovic DVM</option>
                                                                                            <option value="2">Mr. Garnett Mayert Jr.</option>
                                                                                            <option value="4">Imogene Kris</option>
                                                                                            <option value="5">Maritza Parisian</option>
                                                                                            <option value="6">German Fadel</option>
                                                                                            <option value="7">Prof. Loraine Nolan Sr.</option>
                                                                                            <option value="8">Miss Melyssa Schuster DVM</option>
                                                                                            <option value="9">Henry Ziemann</option>
                                                                                            <option value="10">Caleb Morar</option>
                                                                                            <option value="11">Alec Kling</option>
                                                                                            <option value="12">Laury Mayer PhD</option>
                                                                                            <option value="13">Demetris Welch</option>
                                                                                            <option value="14">Angela Cormier</option>
                                                                                            <option value="15">Garret Stracke V</option>
                                                                                            <option value="16">Cary McKenzie</option>
                                                                                            <option value="17">Prof. Van Fadel IV</option>
                                                                                            <option value="18">Prof. Ansley Crona</option>
                                                                                            <option value="19">Dion Bartell Jr.</option>
                                                                                            <option value="20">Prof. Lourdes Macejkovic</option>
                                                                                            <option value="21">Alba Rosenbaum</option>
                                                                                            <option value="22">Dr. Golda Koss</option>
                                                                                            <option value="23">Mr. Jacinto Bernier I</option>
                                                                                            <option value="24">Maci Lebsack</option>
                                                                                            <option value="25">Ms. Hosea Marvin</option>
                                                                                            <option value="26">Prof. Dalton Leannon IV</option>
                                                                                            <option value="27">Mr. Gerald DuBuque DVM</option>
                                                                                            <option value="28">Lyla Gusikowski</option>
                                                                                            <option value="29">Dr. Cortney Reinger</option>
                                                                                            <option value="30">Liza Ankunding</option>
                                                                                            <option value="31">Allie Homenick I</option>
                                                                                            <option value="32">Herta Dibbert</option>
                                                                                            <option value="33">Dominique Flatley</option>
                                                                                            <option value="64">Keven McCullough DVM</option>
                                                                                            <option value="65">Thalia Schuster</option>
                                                                                            <option value="66">Clement Weimann</option>
                                                                                            <option value="67">Hallie Dooley DDS</option>
                                                                                            <option value="68">Reva Purdy</option>
                                                                                            <option value="69">Therese Schmidt</option>
                                                                                            <option value="70">Prof. Ronny Cummings</option>
                                                                                            <option value="71">Miss Marlen Pfannerstill II</option>
                                                                                            <option value="72">Mr. Elmore Von V</option>
                                                                                            <option value="73">Ms. Amara Dickens III</option>
                                                                                            <option value="74">Margret Barton</option>
                                                                                            <option value="75">Ewald Brekke</option>
                                                                                            <option value="76">Adell Dicki DVM</option>
                                                                                            <option value="77">Joshua Jacobs</option>
                                                                                            <option value="78">Florencio Langosh</option>
                                                                                            <option value="79">Kenyatta Krajcik</option>
                                                                                            <option value="80">Ellie Turner</option>
                                                                                            <option value="81">Brayan Williamson Sr.</option>
                                                                                            <option value="82">Mr. Dashawn Carter IV</option>
                                                                                            <option value="83">Etha Turcotte</option>
                                                                                            <option value="84">Cornell Hauck PhD</option>
                                                                                            <option value="85">Alfredo Kunde</option>
                                                                                            <option value="86">Colton Konopelski</option>
                                                                                            <option value="87">Clement O'Keefe III</option>
                                                                                            <option value="88">Miss Reyna Marks Sr.</option>
                                                                                            <option value="89">Curt Hessel</option>
                                                                                            <option value="90">Dr. Olaf Green</option>
                                                                                            <option value="91">Vicente Abernathy</option>
                                                                                            <option value="92">Agustin Goyette</option>
                                                                                            <option value="93">Miss Santina Schulist</option>
                                                                                    </select>
                                    </div>
                                </div>
		                						<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Project</label>
			                                            <select name="project" id="project" class="form-control">
															<option value="">--</option>
																<?php
																	foreach($project as $row)
																	{
																		echo '<option value="'.$row->id.'">'.$row->projectname.'</option>';
																	}
																?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
		                							<div class="form-group">
		                								<label class="control-label">Currency</label>
														<select name="currency" id="currency" class="form-control">
															<option value="">select</option>
															<option value="1" <?php if($estimate[0]->currency=='1'){ echo 'selected'; } ?>>$(USD)</option>
															<option value="2" <?php if($estimate[0]->currency=='2'){ echo 'selected'; } ?>>R(IND)</option>

														</select>
													</div>
		                						</div>
		                					</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Invoice Date</label>
														<div class="row">
														<div class="col-md-12">
															<div class="input-icon">
																<input type="text" class="form-control" name="issue_date" id="invoice_date" value="<?php echo date('Y-m-d'); ?>">
															</div>
														</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Due Date</label>
														<div class="input-icon">
															<input type="text" class="form-control" name="due_date" id="due_date" value="<?php echo !empty($estimate[0]->validtill) ? $estimate[0]->validtill : ''?>">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Status</label>
														<select class="form-control" name="status" id="status">
															<option value="">select</option>
															<option value="1">Paid</option>
															<option value="0">Unpaid</option>                                           
														</select>
													</div>
												</div>
		                					</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Is it a recurring payments? </label>
														<div class="row">
															<div class="col-md-12">
																<select class="form-control" name="recurring_payment" id="recurring_payment" >
																	<option value="0">No</option>
																	<option value="1">Yes</option>
																</select>
															</div>
														</div>
													</div>
												</div>
							
												<div class="col-md-3 recurringPayment showdiv" style="display:none">
													<div class="form-group">
														<label class="control-label">Billing Frequency</label>
														<div class="row">
															<div class="col-md-12">
																<select class="form-control" name="billing_frequency" id="billing_frequency">
																	<option value="0">Day</option>
																	<option value="1">Week</option>
																	<option value="2">Month</option>
																	<option value="3">Year(s)</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3 recurringPayment showdiv"  style="display:none">
													<div class="form-group">
														<label class="control-label">Billing Interval</label>
														<div class="input-icon">
															<input type="text" class="form-control" name="billing_interval" id="billing_interval" value="">
														</div>
													</div>
												</div>
												<div class="col-md-3 recurringPayment showdiv"  style="display:none">
													<div class="form-group">
														<label class="control-label">Billing Cycle</label>
														<div class="input-icon">
															<input type="text" class="form-control" name="billing_cycle" id="billing_cycle" value="">
														</div>
													</div>
												</div>
											
											</div>
											<hr>
											<button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">Products <span class="caret"></span></button>
											<div id="dynamic">
											<?php
												$j=0;
												for($i=0;$i<count($product);$i++)
												{	
													$j++;
											?>
											<div class="row" >
												<div class="form-group">
                                                    <label class="control-label hidden-md hidden-lg">Item</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div>
                                                        <input type="text" class="form-control item_name" name="item_name[]" value="<?php echo !empty($product[$i]->item) ? $product[$i]->item : '' ?>">
                                                    </div>
                                                </div>
												<div class="col-md-1">
													<div class="form-group">
														<label class="control-label hidden-md hidden-lg">Qty/Hrs</label>
														<input type="number" min="1" class="form-control quantity" name="quantity[]" id="quantity<?php echo $j; ?>" value="<?php echo !empty($product[$i]->qtyhrs) ? $product[$i]->qtyhrs : '' ?>">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label hidden-md hidden-lg">Unit Price</label>
														<input type="text" class="form-control cost_per_item" name="cost_per_item[]" id="cost_per_item<?php echo $j; ?>" value="<?php echo !empty($product[$i]->unitprice) ? $product[$i]->unitprice : '' ?>"  onblur="countamount(1);">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label hidden-md hidden-lg">Tax
														<a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#project-tax">
											            	<i class="ti-settings text-info"></i>
											            	</a>
											            	
														</label>
														<select name="tax[]" class="form-control type" id="taxes<?php echo $j; ?>" onchange="counttax(1);">
															<option value="">Select Tax</option>
															<?php
																foreach($tax as $row1)
																{
																	$str="";
																	if($row1->rate==$product[$i]->tax)
																	{
																		$str="selected";
																	}
																	echo '<option value="'.$row1->rate.'"'.$str.'>'.$row1->taxname."(".$row1->rate."%)".'</option>';
																}
															?>
														</select>
													</div>	
												</div>
												<div class="col-md-2 border-dark  text-center">
													<label class="control-label hidden-md hidden-lg">Amount</label>
												<input type="text" name="amount[]" id="amount<?php echo $j; ?>"  value="<?php echo !empty($product[$i]->amount) ? $product[$i]->amount : '' ?>">

													<!--<p class="form-control-static" id="amountdisplay"><span class="amount-html">0.00</span></p>
													<input type="hidden" class="amount" name="amount[]" id="amount1">-->
												</div>
											</div>
											<div class="row">
												<div class="form-group">
													<textarea name="item_Description[]" class="form-control" placeholder="Description" rows="2"><?php echo !empty($product[$i]->description) ? $product[$i]->description : '' ?></textarea>
												</div>
											</div>
										<?php } ?>

										</div>
											<input type="hidden" id="counter" value="<?php echo count($product); ?>">

											<div class="row">
												<div class="col-xs-12 m-t-5">
													<button type="button" class="btn btn-info" id="item-repeat"><i class="fa fa-plus"></i> Add Item</button>
												</div>
											</div>
												<div class="row m-t-5 font-bold">
														<div class="col-md-offset-9 col-md-1 col-xs-6 text-right p-t-10">Total</div>
															<p class="form-control-static col-xs-6 col-md-2"  name="total" id="total">
																<!--<span class="total">0.00</span>-->
															</p>
															<input type="hidden" class="total-field" name="finaltotal" id="finaltotal">
												</div>
											<div class="row">
												<div class="col-md-12">
													<input type="submit" id="save-form" class="btn btn-success" name="btnsubmit" value="Save" > <i class="fa fa-check"></i>
												</div>
											</div>
													
		                				</div>
		                			</form>
		                		</div>
		                	</div>
		                </div>
		            </div>
                </div>
            <!-- ends of contentwrap -->

			<!-- Modal -->
			
			<div class="modal fade project-tax" id="project-tax" tabindex="-1" role="dialog" aria-labelledby="project-tax" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title">Tax</h4>
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
					                    <th>Tax Name</th>
					                    <th>Rate %</th>
					                </tr>
					                </thead>
					                <tbody>
					                    <?php 
										$i = 1;
										foreach ($tax as $row) { ?>      
										      <tr>
										      	  <td><?php echo $i; ?></td>
										          <td><?php echo $row->taxname; ?></td>
										          <td><?php echo $row->rate; ?></td>
										      </tr>
										   <?php
											$i++;
										   } ?>
									</tbody>
					            </table>
					        </div>
					        <hr>
					        <form id="tax" class="" name="tax" method="post" >
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-6 ">
						                    <div class="form-group">
						                        <label>Tax Name</label>
						                        <input type="text" name="tax_name" id="tax_name" class="form-control">
						                    </div>
						                </div>
						                <div class="col-md-6 ">
						                    <div class="form-group">
						                        <label>Rate %</label>
						                        <input type="text" name="rate" id="rate" class="form-control">
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="form-actions">
						            <input type="submit" id="save-category" class="btn btn-success" name="btnsubmit" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>