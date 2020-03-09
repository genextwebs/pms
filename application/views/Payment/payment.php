<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-receipt"></i>Payment</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Payment'?>">Payment</a></li>
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
								ADD PAYMENT
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form class="aj-form" method="post" name="payment" >
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
												<div class="col-md-6">
													<div class="form-group">
													<label class="control-label">Select Project</label>
			                                            <select name="project" id="project" class="form-control">
															<option value="">select</option>
																<?php
																	foreach($project as $row)
																	{
																		echo '<option value="'.$row->id.'">'.$row->projectname.'</option>';
																	}
																?>
														</select>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Paid On</label>
			                                            <input type="text" name="paidon" id="paidon" class="form-control" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d'); ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Currency</label>
														<select name="currency" id="currency" class="form-control">
															<option value="">select</option>
															<option value="1">$(USD)</option>
															<option value="2">R(IND)</option>

														</select>
													</div>
		                						</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Amount</label>
														<div class="row">
														<div class="col-md-12">
															<div class="input-icon">
																<input type="text" class="form-control" name="amount" id="amount" >
															</div>
														</div>
														</div>
													</div>
												</div>
		                					</div>
											<div class= "row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="control-label">Remark</label>
													<textarea name="remark" class="form-control" rows="5"></textarea>
													</div>
												</div>
											</div>
											<input type="hidden" name="userid" id="userid" value="<?php echo $this->user_id; ?>">
											<div class="row">
												<div class="col-md-12">
													<input type="submit" id="pay" class="btn btn-success" name="btnsubmit" value="Pay" > <i class="fa fa-check"></i>
												</div>
											</div>
													
		                				</div>
		                			</form>
		                		</div>
		                	</div>
		                </div>
		            </div>
                </div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var SITEURL = "<?php echo base_url(); ?>";
  $('#pay').on('click', function(e){
  	var project = $('select[name="project"]').val();
  	var paidon = $('input[name="paidon"]').val();
  	var currency = $('select[name="Currency"]').val();
  	var amount = $('input[name="amount"]').val();
  	var remark = $('input[name="remark"]').val();
  	var userid = $('#userid').val();
  //	var cvStatus = $('#cvStatus').val();
  //	var amount = $('#amount').val();*/
    var options = {
    "key": "rzp_test_Mz6ATj37skcz3Z",
    "amount": (amount*100), // 2000 paise = INR 20
    "name": "Indileader",
    "description": "Payment",
    
    "handler": function (response){
    	console.log(response);
          $.ajax({
            url: SITEURL + 'Payment/razorPaySuccess',
            type: 'post',
            dataType: 'json',
            data: { 
                razorpay_payment_id: response.razorpay_payment_id , 
                project : project,
                paidon : paidon,
                currency : currency,
                amount : amount,
                remark :remark,
                userid : userid
              }, 
            success: function (msg) {
              window.location.href = SITEURL + 'Payment/response';
            }
        });
      
    },
 
    "theme": {
        "color": "#528FF0"
    }
    
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });
 
</script>
            <!-- ends of contentwrap -->

		