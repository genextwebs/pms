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



<div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="<?php echo base_url().'Attendance/addattendance' ?>" class="btn btn-success btn-sm">Mark Attendance <i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div>
</div>

<div class="col-md-12">
            <div>
                <div class="row">
                    <div class="col-md-3">
                        <label >Employee</label>
                            <div class="form-group">
                                <select id='employee' name="employee" class="select2 form-control">
                                    <option value="">--</option>
                                    <?php
                                        foreach($employee as $row)
                                        {
                                            echo '<option value="'.$row->id.'" >'.$row->employeename.'</option>';
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
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12" selected>December</option>
                                </select> 
                            </div>
                    </div>
                     <div class="col-md-2">
                        <label class="control-label">Select Year(S)</label>
                            <div class="form-group">
                                <select id='year' name="year" class="select2 form-control" onchange="getattendance(); ">
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    
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

                            <?php for($i=1;$i<=31;$i++)  { ?>
                            <th><?php echo $i; ?></th>   
                            <?php } ?>                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($employee as $row) { 
                            $id=$row->id;
                            ?>
                        <tr>
                            <td><img src="https://demo.worksuite.biz/img/default-profile-2.png" alt="user" class="img-circle" width="30"><?php echo $row->employeename ?></td>
                           <?php for($i=1;$i<=31;$i++)  { 
                                 $date = date('Y-m-d', strtotime('2019'.'-12-'.$i));
                                $data=$this->db->query("select attendance from tbl_attendance where attendancedate='".$date."' and employee=".$id);
                              // echo $this->db->last_query()."<br/>";
                                $result=$data->result_array();
                               $checkattendance=!empty($result[0]['attendance']) ? $result[0]['attendance'] : '0';
                                    
                                //echo "<pre>";print_r($result);die;
                                if($checkattendance == '1' || $checkattendance == '2')
                                {   ?>
                                    <td><i class="fa fa-check text-success"></i> </td>
                               <?php } 
                                else if($checkattendance == '3')
                                {   ?>
                                    <td> <i class="fa fa-times text-danger"></i> </td>               
                                <?php } 
                                else { ?>
                                        <td> <?php echo '-'; ?> </td>
                                        <?php
                                   }
                                
                            
                             } ?>  
                        </tr> 
                        <?php } ?>      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
