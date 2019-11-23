<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataHandler{

	public static function insertData($tableName="",$dataInsert=array(),$id = false){
		$CI =& get_instance();
		if ($tableName=="users") {
			$dataInsert['create_date'] = date("Y-m-d H:i:s");
			$dataInsert['change_date'] = date("Y-m-d H:i:s");
			$dataInsert['change_by'] = $CI->session->userdata('username');
		}else{
			$dataInsert['create_date'] = date("Y-m-d H:i:s");
			$dataInsert['change_date'] = date("Y-m-d H:i:s");
			$dataInsert['change_by'] = $CI->session->userdata('username');
		}
		
		if ($id) {
			$CI->db->insert($tableName,$dataInsert);
			return $CI->db->insert_id();
		}else{
			return $CI->db->insert($tableName,$dataInsert);
		}
	}

	public static function selectData($fields="",$tableName="",$where="",$order="",$group="",$limit=""){
		$CI =& get_instance();
		if ($where!="") {
			$where = " WHERE ".$where;
		}
		if ($order!="") {
			$order = " ORDER BY ".$order;
		}
		if ($group!="") {
			$group = " GROUP BY ".$group;
		}
		if ($limit!="") {
			$limit = " LIMIT ".$limit;
		}
		
		$sql = "SELECT $fields FROM $tableName $where $group $order $limit";
		return $CI->db->query($sql)->result();
	}

	public static function updateData($tableName="",$data=array(),$where=""){
		$CI =& get_instance();
		if ($where!="") {
			$where = " WHERE ".$where;
		}else{
			echo "You cannot update data without where condition !!!";die();
		}
		
		$data['change_date'] = date("Y-m-d H:i:s");
		$data['change_by'] = $CI->session->userdata('username');
		
		$updateFields = " SET ";
		$count = 1;
		foreach ($data as $key => $value) {
			if ($count==count($data)) {
				if ((strripos($value,"(+)")) || (strripos($value,"(-)"))) {
					if (strripos($value,"(+)")) {
						$value = str_replace("(+)", "+", $value);
					}else{
						$value = str_replace("(-)", "-", $value);
					}
					$updateFields .= "$key = $value";
				}else{
					$updateFields .= "$key = '$value'";
				}
			}else{
				if ((strripos($value,"(+)")) || (strripos($value,"(-)"))) {
					if (strripos($value,"(+)")) {
						$value = str_replace("(+)", "+", $value);
					}else{
						$value = str_replace("(-)", "-", $value);
					}
					$updateFields .= "$key = $value,";
				}else{
					$updateFields .= "$key = '$value',";
				}
				$count++;
			}
		}
		$sql = "UPDATE $tableName $updateFields $where";
		return $CI->db->query($sql);
	}

	public static function deleteData($tableName="",$where=""){
		$CI =& get_instance();
		if ($where!="") {
			$where = " WHERE ".$where;
		}else{
			echo "You cannot update data without where condition !!!";die();
		}
	
		$sql = "DELETE FROM $tableName $where";
		return $CI->db->query($sql);
	}

	public function debug($data=array(),$die = true){
		echo "<pre>";
		print_r($data);
		if ($die==true) {
			die();
		}
	}

	public static function genForm($dataTbl=array(),$allData=array(),$urlAction=""){
		$form = '<form role="form" class="form-horizontal" action="'.base_url().$urlAction.'" method="POST" enctype="multipart/form-data">
					<div class="box-body">';
		foreach ($dataTbl as $key => $data) {
			if(!$data['custom']){
				if ($data['type']=='hidden') {
					if ($allData['statEdit']==true) {
						$val = $allData['dataEdit'][0]->$data['name']; 
						$form .='<input type="'.$data['type'].'" name="'.$data['name'].'" id="'.$data['id'].'" class="form-control" 
				                          value="'.$val.'" >';
					}
				}elseif($data['type']=='text' || $data['type']=='number'){
					$val = "";
					if ($allData['statEdit']==true) {
						$val = $allData['dataEdit'][0]->$data['name']; 
					}
					$form .=    '<div class="form-group">
				                  <label class="col-sm-2 control-label">'.$data['label'].'</label>
				                  <div class="col-sm-10">
				                          <input type="'.$data['type'].'" name="'.$data['name'].'" id="'.$data['id'].'" class="form-control" 
				                          value="'.$val.'" >
				                  </div>
				                </div>';
				}elseif($data['type']=='select'){
					if ($data['t_select']==1) {
						$valSel = "";
						$chooseChek = false;
						for ($i=0; $i <count($allData[$data['v_select']]) ; $i++) {
							$valSel .= '<option  value="'.$allData[$data['v_select']][$i][$data['id_select']].'"';
	                       	if ($allData['statEdit']==true) {
	                          if($allData['dataEdit'][0]->$data['name']==$allData[$data['v_select']][$i][$data['id_select']]){
	                             $valSel .= 'selected ';
	                             $chooseChek = true;
	                          }
	                        } 
	                        $valSel .= '>'.$allData[$data['v_select']][$i][$data['name']].'</option>';
	                    }

	                    if (!$chooseChek) {
	                    	$valSel = "<option value=''>Belum di Set</option>".$valSel;
	                    }
						$form .= '<div class="form-group">
					                  <label class="col-sm-2 control-label">'.$data['label'].'</label>
					                  <div class="col-sm-10">
					                    <select class="form-control" name="'.$data['name'].'" id="'.$data['id'].'">
					                      '.$valSel.'
					                    </select>
					                  </div>
					                </div>';
					}elseif($data['t_select']==2){
						$valSel = "";
						for ($i=1; $i <count($allData[$data['v_select']])+1 ; $i++) {
							$valSel .= '<option  value="'.$allData[$data['v_select']][$i].'"';
	                       	if ($allData['statEdit']==true) {
	                          if($allData['dataEdit'][0]->$data['id_select']==$allData[$data['v_select']][$i]){
	                             $valSel .= 'selected ';
	                          }
	                        } 
	                        $valSel .= '>'.$allData[$data['v_select']][$i].'</option>';
	                    }
						$form .= '<div class="form-group">
					                  <label class="col-sm-2 control-label">'.$data['label'].'</label>
					                  <div class="col-sm-10">
					                    <select class="form-control" name="'.$data['name'].'" id="'.$data['id'].'">
					                      '.$valSel.'
					                    </select>
					                  </div>
					                </div>';
					}elseif ($data['t_select']==3) {
						$valSel = "";
						$chooseChek = false;
						for ($i=0; $i <count($allData[$data['v_select']]) ; $i++) {
							$valSel .= '<option  value="'.$allData[$data['v_select']][$i][$data['id_select']].'"';
	                       	if ($allData['statEdit']==true) {
	                          if($allData['dataEdit'][0]->$data['name']==$allData[$data['v_select']][$i][$data['id_select']]){
	                             $valSel .= 'selected ';
	                             $chooseChek = true;
	                          }
	                        } 
	                        $valSel .= '>'.$allData[$data['v_select']][$i][$data['n_ref']].'</option>';
	                    }

	                    if (!$chooseChek) {
	                    	$valSel = "<option value=''>Belum di Set</option>".$valSel;
	                    }
						$form .= '<div class="form-group">
					                  <label class="col-sm-2 control-label">'.$data['label'].'</label>
					                  <div class="col-sm-10">
					                    <select class="form-control" name="'.$data['name'].'" id="'.$data['id'].'">
					                      '.$valSel.'
					                    </select>
					                  </div>
					                </div>';
					}
				}elseif($data['type']=='date'){
					$val = "";
					if ($allData['statEdit']==true) {
						$val = $allData['dataEdit'][0]->$data['name']; 
					}
					$form.='<div class="form-group">
			                  <label class="col-sm-2 control-label">'.$data['label'].'</label>
			                  <div class="col-sm-10">
			                          <input type="text" data-date-format=\'yyyy-mm-dd\' id="'.$data['id'].'" name="'.$data['name'].'" class="form-control" 
			                          value="'.$val.'">
			                  </div>
			                </div>';
				}
			}
		}
		$form .='</div>
				  <div class="box-footer">
	                <button type="submit" class="btn btn-primary">Simpan</button>
	                <a class="btn btn-danger" href="javascript: history.go(-1)">kembali</a>
	              </div>
	            </form>';
		return $form;
	}

	public static function genTable($dataTbl=array(),$idTable=""){
		$CI =& get_instance();
		$table = '';
		if ($CI->session->flashdata('success')) { 
			$table .='<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				'.$this->session->flashdata('success').'
				</div>';
		}

		if ($CI->session->flashdata('error')) {
			$table .='<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				'.$this->session->flashdata('error').'
				</div>';
		}

		if ($CI->session->flashdata('warning')) {
			$table .='<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-warning"></i> Warning!</h4>
				'.$this->session->flashdata('warning').'
				</div>';
		}

		$table .=  '<table id="'.$idTable.'" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>No</th>';
		foreach ($dataTbl as $key => $data) {
			if ($data['show']) {
				$table .= '<th>'.$data['label'].'</th>';
			}
		}
		$table .= '		<th>Aksi</th>
					</tr>
                </thead>
                <tbody>
                </tbody>
              </table>';
        return $table;
	}

}