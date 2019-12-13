<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-clock"></i> Attendance</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li class="active">Attendance</li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="content-in"> 
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="<?php echo base_url().'Attendance/addattendance' ?>" class="btn btn-success btn-sm">Mark Attendance <i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="col-md-12">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <label >Employee</label>
                                <div class="form-group">
                                    <select id='employee' name="employee" class="select2 form-control">
                                        <option value="all">All Employee</option>
                                        <?php
                                            foreach($employee as $row){
                                                $sel = '';
                                                if($row->id == $selEmployee){
                                                    $sel = 'selected=selected';
                                                }
                                                echo '<option value="'.$row->id.'" '.$sel.'>'.$row->employeename.'</option>';
                                            }
                                        ?>
                                    </select> 
                                </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Department</label>
                                <div class="form-group">
                                    <select id='department' name="department" class="select2 form-control">
                                        <option value="all">All</option>
                                        <?php
                                            foreach($department as $row)
                                            {
                                                 $sel = '';
                                                if($row->department == $selDepartment){
                                                    $sel = 'selected=selected';
                                                }
                                                echo '<option value="'.$row->id.'" >'.$row->name.'</option>';
                                            }
                                        ?>
                                    </select> 
                                </div>
                        </div>
                        
                        <div class="col-md-2">
                            <label class="control-label">Select Month</label>
                                <div class="form-group">
                                    <select id='month' name="month" class="select2 form-control">
                                        <option value="01" <?php if($selMonth == '01'){ echo 'selected'; }?>>January</option>
                                        <option value="02" <?php if($selMonth == '02'){ echo 'selected'; }?>>February</option>
                                        <option value="03" <?php if($selMonth == '03'){ echo 'selected'; }?>>March</option>
                                        <option value="04" <?php if($selMonth == '04'){ echo 'selected'; }?>>April</option>
                                        <option value="05" <?php if($selMonth == '05'){ echo 'selected'; }?>>May</option>
                                        <option value="06" <?php if($selMonth == '06'){ echo 'selected'; }?>>June</option>
                                        <option value="07" <?php if($selMonth == '07'){ echo 'selected'; }?>>July</option>
                                        <option value="08" <?php if($selMonth == '08'){ echo 'selected'; }?>>August</option>
                                        <option value="09" <?php if($selMonth == '09'){ echo 'selected'; }?>>September</option>
                                        <option value="10" <?php if($selMonth == '10'){ echo 'selected'; }?>>October</option>
                                        <option value="11" <?php if($selMonth == '11'){ echo 'selected'; }?>>November</option>
                                        <option value="12" <?php if($selMonth == '12'){ echo 'selected'; }?>>December</option>
                                    </select> 
                                </div>
                        </div>
                         <div class="col-md-2">
                            <label class="control-label">Select Year(S)</label>
                                <div class="form-group">
                                    <select id='year' name="year" class="select2 form-control">
                                        <option value="2019" <?php if($selYear == '2019'){ echo 'selected'; }?>>2019</option>
                                        <option value="2018" <?php if($selYear == '2018'){ echo 'selected'; }?>>2018</option>
                                        <option value="2017" <?php if($selYear == '2017'){ echo 'selected'; }?>>2017</option>
                                        <option value="2016" <?php if($selYear == '2016'){ echo 'selected'; }?>>2016</option>
                                        <option value="2015" <?php if($selYear == '2015'){ echo 'selected'; }?>>2015</option>
                                        
                                    </select> 
                                </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group m-t-25">
                                <button type="button" id="apply-filter"  class="btn btn-success btn-block">Apply</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="attendance-data">
            <div class="white-box">
                <div class="table-responsive tableFixHead">
                    <table class="table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <?php 
                                if($selMonth == '01' || $selMonth == '03'  || $selMonth == '05'|| $selMonth == '07' || $selMonth == '08' || $selMonth == '10'|| $selMonth == '12') {
                                    $endLoopIndex = 31;
                                }
                                elseif($selMonth == '04' || $selMonth == '06'  || $selMonth == '09' || $selMonth == '11') {
                                    $endLoopIndex = 30;
                                }
                                else{
                                    if($selYear % 4 == 0) {  
                                        $endLoopIndex = 29;
                                    }
                                    else{
                                        $endLoopIndex = 28;
                                    }
                                }
                                for($i=1;$i<=31;$i++)  {
                                    echo '<th>'.$i.'</th>';
                                }
                                ?>                 
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($selEmployeeArr as $row) { 
                                $id=$row->id;
                                ?>
                                <tr>
                                    <td>
                                        <img src="https://demo.worksuite.biz/img/default-profile-2.png" alt="user" class="img-circle" width="30">
                                        <?php echo $row->employeename; ?>
                                    </td>
                                    <?php 
                                    if($selMonth == '01' || $selMonth == '03'  || $selMonth == '05'|| $selMonth == '07' || $selMonth == '08' || $selMonth == '10'|| $selMonth == '12') {
                                        $endLoopIndex = 31;
                                    }
                                    elseif($selMonth == '04' || $selMonth == '06'  || $selMonth == '09' || $selMonth == '11') {
                                        $endLoopIndex = 30;
                                    }
                                    else{
                                        if($selYear % 4 == 0) {  
                                            $endLoopIndex = 29;
                                        }
                                        else{
                                            $endLoopIndex = 28;
                                        }
                                    }

                                    for($i=1;$i<=$endLoopIndex;$i++)  {
                                        $date = date('Y-m-d', strtotime($selYear.'-'.$selMonth.'-'.$i));
                                        $dateDay = date('l', strtotime($date));
                                        $attendanceData=$this->db->query("select attendance from tbl_attendance where attendancedate='".$date."' and employee=".$id);
                                        // echo $this->db->last_query()."<br/>";
                                        $attendanceResult = $attendanceData->result_array();
                                        $checkattendance = !empty($attendanceResult[0]['attendance']) ? $attendanceResult[0]['attendance'] : '0';
                                            
                                        //echo "<pre>";print_r($result);die;
                                        if($checkattendance == '1' || $checkattendance == '2'){   ?>
                                            <td><i class="fa fa-check text-success"></i> </td>
                                        <?php } 
                                        else if($checkattendance == '3'){   ?>
                                            <td> <i class="fa fa-times text-danger"></i> </td>               
                                        <?php } 
                                        else if($dateDay == 'Sunday'){   ?>
                                            <td> <?php echo 'sun' ?></td>
                                        <?php 
                                        }
                                        else { ?>
                                            <td> <?php echo '-'; ?> </td>
                                            <?php
                                        }
                                    } 
                                   ?>
                                </tr> 
                            <?php } ?>      
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

    
            


    
