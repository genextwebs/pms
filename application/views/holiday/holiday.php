<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Holiday List Of 2019</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>
                            ">Home</a></li>
                            <li class="active">Holiday List Of 2019</li>
                        </ol>
                    </div>
                </div>
            </nav>
            <div class="col-sm-12">
                        <div class="form-group pull-left">
                            <a href="javahref="javascript:;" id="tax-settings" data-toggle="modal" data-target="#data-holiday">Add Holiday <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                        
                        <div class="pull-right" style="margin-right: 10px">
                            <a class="btn btn-outline btn-sm btn-primary markHoliday" onclick="showMarkHoliday()">
                                 Mark Default Holidays<i class="fa fa-check"></i> </a>
                        </div>
                    </div>
   <br/>                 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#January">January</a></li>
    <li><a data-toggle="tab" href="#February">February</a></li>
    <li><a data-toggle="tab" href="#March">March</a></li>
    <li><a data-toggle="tab" href="#April">April</a></li>
    <li><a data-toggle="tab" href="#May">May</a></li>
    <li><a data-toggle="tab" href="#June">June</a></li>
    <li><a data-toggle="tab" href="#July">July</a></li>
    <li><a data-toggle="tab" href="#Augest">Augest</a></li>
    <li><a data-toggle="tab" href="#September">September</a></li>
    <li><a data-toggle="tab" href="#October">October</a></li>
    <li><a data-toggle="tab" href="#November">November</a></li>
    <li><a data-toggle="tab" href="#December">December</a></li>
  </ul>
  <div class="tab-content">
    <div id="January" class="tab-pane fade in active">
      <h3>January</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $SaturdayChk = 1;
                    $SundayChk = 1;
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime('2019-01-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($janArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $janArr[$date]; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="February" class="tab-pane fade">
      <h3> February </h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="March" class="tab-pane fade">
      <h3>March</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="April" class="tab-pane fade">
      <h3>April</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="May" class="tab-pane fade">
      <h3>May</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="June" class="tab-pane fade">
      <h3>June</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="July" class="tab-pane fade">
      <h3>July</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="Augest" class="tab-pane fade">
      <h3>Augest</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="September" class="tab-pane fade">
      <h3>September</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="October" class="tab-pane fade">
      <h3>October</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="November" class="tab-pane fade">
      <h3>November</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="December" class="tab-pane fade">
      <h3>December</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
  </div>


<!-- model for add holiday -->
<div class="modal fade holiday" id="data-holiday" tabindex="-1" role="dialog" aria-labelledby="holiday" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content br-0">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i>Holiday</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modelholiday" class="" name="modelholiday" method="post" >
                                <div class="form-body">
                                <div id="dynamic">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <input type="text" name="holiday_name[]" id="start_date"  placeholder="Date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">  
                                                <div class="form-group">
                                                    <input type="text" name="occasion[]" id="occasion"  placeholder="Occasion" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <input type="hidden" id="counter" value="1">
                                        <button type="button" id="repeate-data" class="btn btn-sm btn-info" style="margin-bottom: 20px">
                                            Add <i class="fa fa-plus"></i></button>
                                        </div>
                                </div>
                                
                                <div class="form-actions">
                                    <input type="button" id="save-holiday" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
