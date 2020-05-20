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
	<form id="timelogreport" class="aj-form--" name="timelogreport" method="post" action="<?php echo base_url().'TimeLogReport/getPostData';?>">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">SELECT DATE RANGE</label>
		    		<div class="input-group input-daterange">
				  	    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="<?php echo $sdate;?>" data-date-format='yyyy-mm-dd'>
				   		<div class="input-group-prepend">
				        	<span class="input-group-text bg-info text-white">To</span>
			    		</div>
			  		    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="<?php echo $edate;?>" data-date-format='yyyy-mm-dd'>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Select Project</label>
					<select id="projectData" class="custom-select" name="projectData">
						<option value="">--Select--</option>
							<?php foreach($allProjectData as $project){ ?>
								<option value="<?php echo $project->id; ?>"><?php echo $project->projectname; ?></option>
							<?php } ?>
					</select> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
	            <div class="form-group m-t-10">
	                <label class="control-label col-12 mb-3">&nbsp;</label>
	                <button type="submit" id="btnApplyTimeReport" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
	            </div>
	        </div>
	    </div>
	</form>
	<div id="container" style="height: 400px"></div>
	<?php
	    $str='';$str1='';
		foreach($finalTempArr as $key=>$value){
			$str.= '"'.$key.'"'.',';
			$str1.= $value.',';
		}
		//echo $str;die;
	?>
	<script type="text/javascript">
		Highcharts.chart('container', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'TimeLog Report'
		    },
		  
		    xAxis: {
		        categories: [<?php echo rtrim($str,',');?>],
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		        //    text: 'Rainfall (mm)'
		        }
		    },
		    series: [{
		        name: 'HourseLogged',
		        data: [<?php echo rtrim($str1,',');?>]
		        //data:[50.0,47.0,0.0]
		    },]
		});
	</script>
</div>



