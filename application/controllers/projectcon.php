<?php
public function templatelist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectname', 'projectmember' , 'projectcategory');
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
            	//$sWhere .= ' AND (companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
				$whereStr.= ' AND (tbl_project_template.projectname like "%'.$searchTerm.'%" OR tbl_project_template.projectcategory like "%'.$searchTerm.'%")';
			}
            if(!empty($sWhere)){
            	$sWhere = " WHERE 1 ".$sWhere;
            }
            /** Filtering End */
		}
		
	    $query = "SELECT * from tbl_project_template ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$templateArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_project_template ".$sWhere;
		$TemplateFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($TemplateFilterArr);

		$TemplateAllArr = $this->common_model->getData('tbl_project_template');
		$iTotal = count($TemplateAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($templateArr as $row) {
			$id = $row->id;
			$whereArr = array('id'=> $project->clientid);
			//$clientArr = $this->common_model->getData('tbl_clients', $whereArr);		
			$datarow[] = array(
				$id = $i,
                //$id=$project->id,
				$project->projectname,
				"<a href='".base_url()."P/template_data/".$id."'> Add Template Members</a>",
				$project->projectcategory,
						
           	);
           	$i++;
      	}
        
		$output = array
		(
		    "sEcho" => intval($_POST['sEcho']),
				   "iTotalRecords" => $iTotal,
				   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
				   "iTotalDisplayRecords" => $iFilteredTotal,
				   "aaData" => $datarow
		);
	  echo json_encode($output);
      exit();
	}
