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
<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Attendance Date</label>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-icon">
                        <input type="text" class="form-control" name="attendancedate" id="startdate" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd'>
                    </div>
                </div>
            </div>
    </div>
</div>

        <div class="table-responsive">
             <table class="table table-bordered" id="Attendancetable">
                 <thead>
                    
                    <th>Employee</th>
                    <th>Attendance</th> 


                 </thead>
                <tbody>
                  
                        <?php foreach($employee as $row) { 
                             $id=$row->id;
                            ?>
                          
                            <tr>
                               
                               
                                <td> <?php  echo $row->employeename;  echo $row->id; ?>
                                    <input type="hidden" value="<?php echo $row->id; ?>" id="employee" >
                                 </td>
                                <td>
                                    <input type="radio" name="attendance" value="2">Late<br>
                                    <input type="radio" name="attendance" value="1">Present<br>
                                    <input type="radio" name="attendance" value="3">Absent<br>
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