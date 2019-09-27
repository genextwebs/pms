<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	}
	
	public function index(){
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$tempArr=array();
		foreach($data['employee'] as $row)
		{
			$skill = $row->skills;
			$array = explode(",",$skill);
			
			if(!empty($tempArr)){
				$tempArr = array_merge($array,$tempArr);
			}
			else{
				$tempArr = $array;
			}
		}
		$data['skillArr'] = array_unique($tempArr);
		$this->load->view('common/header');
		$this->load->view('employees/employees',$data);
		$this->load->view('common/footer');
	}

	public function addemployee(){
		$this->load->view('common/header');
		$data['sessData'] = $this->session->flashdata('data');
		$data['error_msg'] = $this->session->flashdata('error');
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		$this->load->view('employees/addemployee',$data);
		$this->load->view('common/footer');
	}

	public function insertemployee(){
		if(!empty($_POST)){
			$employee_name = $this->input->post('employee_name');
			$employee_email = $this->input->post('employee_email');
			$password = $this->input->post('password');
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$username = $this->input->post('username');
			$joiningdate = $this->input->post('joining-date');
			$lastdate = $this->input->post('last-date');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$skills = $this->input->post('skills');
			$designation = $this->input->post('designation');
			$department = $this->input->post('department');
			$hourlyrate = $this->input->post('hourly-rate');
			$login = $this->input->post('login');
			//$profilepicture = $this->input->post('imagename');
			$config = array(
							'upload_path' => './uploads/',
							'allowed_types' => 'gif|jpg|png',
							'max_size' =>'1000',
							'max_width'=>'1024',
							'max_height' => '768'
							);
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$profilepicture = '';
			if($this->upload->do_upload('profilepicture')){
				$profilepicture = array('upload_data'=>$this->upload->data());
				$insArr = array('employeename'=>$employee_name,'employeeemail'=>$employee_email,'password'=>md5($password),'genereterandompassword'=>$grp,'mobile'=>$mobile,'slackusername'=>$username,'joingdate'=>$joiningdate,'lastdate'=>$lastdate,'gender'=>$gender,'address'=>$address,'skills'=>$skills,'designation'=>$designation,'department'=>$department,'hourlyrate'=>$hourlyrate,'status'=>'0','login'=>$login,'profilepicture'=>$profilepicture['upload_data']['file_name']);
				
			$this->common_model->insertData('tbl_employee',$insArr);
			}
			else{
				$error = array('error' => $this->upload->display_errors());
				//print_r($error);die;
				$this->session->set_flashdata("error",$error);
				$this->session->set_flashdata("data",$_POST);
				redirect('employee/addemployee');			
			}
			redirect('employee');
		}			
	}

	public function insert_designation(){
		if(!empty($_POST)){
			$name = $this->input->post('name');
			$insArr = array('name'=>$name);
			$this->common_model->insertData('tbl_designation',$insArr);
			$designationArray = $this->common_model->getData('tbl_designation');
			$str = '';
			foreach($designationArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$txtArr = array();
			$txtArr['taxdata'] = $str;
			echo  json_encode($txtArr);exit; 
		}
	}

	public function insert_department(){
		if(!empty($_POST)){
			$name = $this->input->post('name');
			$insArr = array('name'=>$name);
			$this->common_model->insertData('tbl_department',$insArr);
			$designationArray = $this->common_model->getData('tbl_department');
			$str = '';
			foreach($designationArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$txtArr = array();
			$txtArr['taxdata'] = $str;
			echo  json_encode($txtArr);exit; 
		}
	}

// image upload through ajax
	public function do_upload()
	{
		if(!empty($_FILES))
		{
			$config['upload_path']= './uploads/';
			$config['allowed_types']='gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			 
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
				if(!$this->upload->do_upload('profilepicture'))  
				{  
					$data['error']= $this->upload->display_errors();  
				}
				else
				{
					$data['error']='';
					$image= array('upload_data' => $this->upload->data());
					$data['image']= $image['upload_data']['file_name']; 
				}
		}
		else
		{
			$data['error']='Not select photo';
		}
        echo json_encode($data);
    }

    public function employee_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'employeename', 'employeeemail', 'status','createdat');
			//'ahrefs_dr', 
            $totalColumns = count($aColumns);

			/** Paging Start **/
            $sLimit = "";
            $sOffset = "";
            if ($_GET['iDisplayStart'] < 0) {
                $_GET['iDisplayStart'] = 0;
            }
            if ($_GET['iDisplayLength'] < 0) {
                $_GET['iDisplayLength'] = 10;
            }
            if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
                $sLimit = (int) substr($_GET['iDisplayLength'], 0, 6);
                $sOffset = (int) $_GET['iDisplayStart'];
            } else {
                $sLimit = 10;
                $sOffset = (int) $_GET['iDisplayStart'];
            }
            /** Paging End **/
            /** Ordering Start **/
            $noOrderColumns = array('other_do_ext');
            if (isset($_GET['iSortCol_0']) && !in_array($aColumns[intval($_GET['iSortCol_0'])], $noOrderColumns)) {
                $sOrder = " ";
                for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                    if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {

                        if ($aColumns[intval($_GET['iSortCol_' . $i])] != '') {
                            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
                        } 
                        else {
                            $sOrder = $defaultOrderClause . " ";
                        }

                        $sortColumnName = intval($_GET['iSortCol_' . $i]).'|'.$_GET['sSortDir_' . $i];
                    }
                }

                $sOrder = substr_replace($sOrder, "", -2);
                if ($sOrder == "ORDER BY") {
                    $sOrder = "";
                }
            } else {
                $sOrder = $defaultOrderClause;
            }

            if(!empty($sOrder)){
            	$sOrder = " ORDER BY ".$sOrder;
            }
            /** Ordering End **/

            /** Filtering Start */
            if(!empty(trim($_GET['sSearch']))){
            	$searchTerm = trim($_GET['sSearch']);
            	$sWhere .= ' AND (employeename like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR skills like "%'.$searchTerm.'%" OR slackusername like "%'.$searchTerm.'%")';
            }
			$status = !empty($_POST['status']) ? $_POST['status'] : '';
			$employee = !empty($_POST['employeename']) ? $_POST['employeename'] : '';
			$skill = !empty($_POST['skill']) ? $_POST['skill'] : '';
			$skill = !empty($_POST['designation']) ? $_POST['designation'] : '';
			$skill = !empty($_POST['department']) ? $_POST['department'] : '';
			if(!empty($employee)){
				$sWhere =' AND  id="'.$employee.'"';
			}
			if($status=='All'){
			}
			else{
				$sWhere =' AND  status='.$status;
			}
            if(!empty($sWhere)){
            	$sWhere = " WHERE 1 ".$sWhere;
            }
            /** Filtering End */
		}
		
	    $query = "SELECT * from tbl_employee ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$empsArr = $this->common_model->coreQueryObject($query);
		//echo $this->db->last_query();die;
		$query = "SELECT * from tbl_employee ".$sWhere;
		$empsFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($empsFilterArr);

		$empsAllArr = $this->common_model->getData('tbl_employee');
		$iTotal = count($empsAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($empsArr as $row) {
			$id = $row->id;
			if($row->status == '0'){
				$st = $row->status = 'Active';
				$status = '<label class="label label-success">'.$st.'</label>';
			}
			else{
				$st = $row->status = 'Inactive';
				$status = '<label class="label label-danger">'.$st.'</label>';
			}
			$create_date = date('d-m-Y', strtotime($row->created_at));
			$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."employee/editemployee/".base64_encode($row->id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"View Employee Detail\"><a class=\"btn btn-success btn-circle\" data-toggle=\"tooltip\" data-original-title=\"search\" href='".base_url()."employee/viewemployee/".base64_encode($row->id)."'><i class=\"fa fa-search\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void(0);\" onClick='deleteemployee(\"".base64_encode($row->id)."\");'><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";
			$datarow[] = array(
				$id = $i,
                $row->employeename,
                $row->employeeemail,

				$status,
				$create_date,
				$actionStr
           	);
           	$i++;
      	}
        
		$output = array
		(
		   	"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
	        "iTotalDisplayRecords" => $iFilteredTotal,
	        "aaData" => $datarow
		);
	  echo json_encode($output);
      exit();
	}

	public function editemployee(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['employee'] = $this->common_model->getData('tbl_employee',$whereArr);
		$data['sessData'] = $this->session->flashdata('data');
		$data['error_msg'] = $this->session->flashdata('error');
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		$this->load->view('common/header');
		$this->load->view('employees/editemployee',$data);
		$this->load->view('common/footer');
		if(!empty($_POST)){
			$employee_name = $this->input->post('employee_name');
			$employee_email = $this->input->post('employee_email');
			$updateArr=array();
			if($this->input->post('password') != '')
			{
				$updateArr['password'] = md5($this->input->post('password'));
			}
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$username = $this->input->post('username');
			$joiningdate = $this->input->post('joining-date');
			$lastdate = $this->input->post('last-date');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$skills = $this->input->post('skills');
			$designation = $this->input->post('designation');
			$department = $this->input->post('department');
			$hourlyrate = $this->input->post('hourly-rate');
			$status = $this->input->post('status');
			$login = $this->input->post('login');
			$imagename = '';
			$imgerror = 0;
			//print_r($_FILES);die;
			if(!empty($_FILES['profilepicture']['name'])){
				$config = array(
							'upload_path' => './uploads/',
							'allowed_types' => 'gif|jpg|png',
							'max_size' =>'1000',
							'max_width'=>'1024',
							'max_height' => '768'
							);
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
				if($this->upload->do_upload('profilepicture')){
					$imagename = array('upload_data' => $this->upload->data());
					$profilepicture = $imagename['upload_data']['file_name'];
				}
				else{
					$imgerror = 1;
				}
			}
			else{
				$profilepicture = $this->input->post('image');
			}
			if($imgerror == 0){
				$updateArr['employeename'] = $employee_name;
				$updateArr['employeeemail'] = $employee_email;
				$updateArr['genereterandompassword'] = $grp;
				$updateArr['mobile'] = $mobile;
				$updateArr['slackusername'] = $username;
				$updateArr['joingdate'] = $joiningdate;
				$updateArr['lastdate'] = $lastdate;
				$updateArr['gender'] = $gender;
				$updateArr['address'] = $address;
				$updateArr['skills'] = $skills;
				$updateArr['designation'] = $designation;
				$updateArr['department'] = $department;
				$updateArr['hourlyrate'] = $hourlyrate;
				$updateArr['status'] = $status;
				$updateArr['login'] = $login;
				$updateArr['profilepicture'] = $profilepicture;
			//print_r($updateArr);die;
			$this->common_model->updateData('tbl_employee',$updateArr,$whereArr);
		}
		else{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata("error",$error);
			$this->session->set_flashdata("data",$_POST);
			redirect('employee/editemployee');

		}
		redirect('employee');
	}			
	}

	public function deleteemployee(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id'=>$id);
		$this->common_model->deleteData('tbl_employee',$whereArr);
		redirect('employee');
	}

}
?>