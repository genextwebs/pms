<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-clock"></i> Attendance</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li> 
                <li><a href="<?php echo base_url().'Attendance'?>">Attendance</a></li>
                <li class="active"> Mark Attendance</li>
            </ol>
        </div>
    </div>
</nav>
<form class="aj-form" method="post" action="<?php echo base_url().'Attendance/insertattendance' ?>" name="addattendance" >

    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Attendance Date</label>
            <input type="text" class="form-control" name="attendancedate" id="startdate" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd'>
        </div>
    </div>


        <div class="table-responsive">
             <table class="table table-bordered" id="Attendance">
                 <thead>
                    
                    <th>Employee</th>
                    <th>Attendance</th> 


                 </thead>
                <tbody>
                   
                        <?php foreach($employee as $row) { 
                             $id=$row->id;
                            ?>
                            
                            <tr>
                               
                               
                                <td> <?php  echo $row->employeename;  
                                ?>
                                    <input type="hidden" value="<?php echo $row->id; ?>" id="employee" >
                                 </td>
                                 <?php 
                                        $Tdate=date('Y-m-d'); 
                                        $todayData=$this->db->query("select * from tbl_attendance where attendancedate='".$Tdate."' and employee=".$id);
                                      // echo $this->db->last_query()."<br/>";

                                        $todayAttenData = $todayData->result_array(); 
                                print_r($todayAttenData);
                                    
                          ?>
                                <td><?php  ?>
                                    <input type="radio" name="attendance" value="2" 
                                    <?php if(!empty($todayAttenData[0]['attendance']) == 2) 
                                    { echo 'checked'; }?>>Late<br>
                                    <input type="radio" name="attendance" value="1"  
                                    <?php if(!empty($todayAttenData[0]['attendance']) == 1){ echo 'checked'; } ?>>Present<br>
                                    <input type="radio" name="attendance" value="3"  
                                    <?php if(!empty($todayAttenData[0]['attendance']) == 3) { echo 'checked'; } ?>>Absent<br>
                                </td>
                                <td>
                                    <input type="button" id="attendanceform" onclick="insertAttendance('<?php echo $id ?>')" class="btn btn-success" name="btnsubmit" value="Save" > <i class="fa fa-check"></i>
                                </td>
                               
                            </tr>
                            
                        <?php } ?>
                    
                </tbody>
             </table>
        </div>
</form>