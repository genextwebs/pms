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
                <a href="https://demo.worksuite.biz/admin/attendances/create" class="btn btn-success btn-sm">Mark Attendance <i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div>
</div>

        <div class="table-responsive">
             <table class="table table-bordered" id="Attendance">
                 <thead>
                    
                    <th>Employee</th>
                    <th>Attendance</th> 
                 </thead>
                <tbody>
                   <form class="aj-form" method="post" action="<?php echo base_url().'Attendance/insertattendance' ?>" name="addattendance" >
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
                                    <input type="radio" name="attendance" value="0">Absent<br>
                                </td>
                                <td>
                                    <input type="button" id="attendanceform" onclick="insertAttendance('<?php echo $id ?>')" class="btn btn-success" name="btnsubmit" value="Save" > <i class="fa fa-check"></i>
                                </td>
                               
                            </tr>
                            
                        <?php } ?>
                    </form>
                </tbody>
             </table>
        </div>