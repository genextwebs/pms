<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i>Time Log Report</h4>
		</div>
		 <div class="col-lg-9 col-sm -8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Time Log Report</li>
			</ol>
		</div>
	</div> 
</nav>


	<div class="content-in">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">SELECT DATE RANGE</label>
			    		<div class="input-group input-daterange">
					  	    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="" data-date-format='yyyy-mm-dd'>
					   		<div class="input-group-prepend">
					        	<span class="input-group-text bg-info text-white">To</span>
				    		</div>
				  		    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="" data-date-format='yyyy-mm-dd'>
						</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Select Project</label>
					<select id="projectData" class="custom-select" name="projectData">
						<option value="">--Select--</option>
							<?php 
								foreach($allProjectData as $project){
							?>
							<option value="<?php echo $project->id; ?>"><?php echo $project->projectname; ?></option>
							<?php	
					
							}
							?>
					</select> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
	            <div class="form-group m-t-10">
	                <label class="control-label col-12 mb-3">&nbsp;</label>
	                <button type="button" id="btnApplyTimeReport" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
	            </div>
	        </div>
	    </div>
	</div>
	 <div id="container">
	 	
	 </div>
</div>
<script type="text/javascript">
	function columnChart(data){
	$var=data;
	alert('var---'+$var);
	var data_click = <?php echo $click; ?>;
    var data_viewer = <?php echo $viewer; ?>;
  
		$(function() {
   			 var chart = new Highcharts.Chart({

        	chart: {
           		    renderTo: 'container',
          		    type: 'column'
        	},
        	xAxis: {
            	categories: ['2013','2014','2015', '2016']
        	},
    		yAxis: {
        		title: {
            		text: 'Rate'
        		}
    		},
        	/*yAxis: {
            		title: {
                		text: 'axis title',
                		useHTML: true,
                	style: {
                    	rotation: 90
                	}
            	}
        	},*/

        series: [{
            data: [20023,4005,12,89,123,12,5]}]

    	 });

		});
    }

</script>




