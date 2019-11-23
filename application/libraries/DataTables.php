<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataTables{

	public static function getRequest($table_name="",$tbl_id="",$hide_column="",$columns=array(),$custom_where="",$custom_order="",$custom_if=array(),$method_link=array(),$icon_img=array(),$custom_group="",$custom_link=array(),$custom_field=array(),$custom_thick=false,$requestMenu="",$custom="")
	{
		$requestData= $_REQUEST;
		$CI =& get_instance();
		$custom_where2= "";
		if ($custom_where!="") {
			$custom_where2 = " where ".$custom_where;
		}
		$sql_raw = "SELECT count(*) as total FROM ".$table_name." ".$custom_where2;
		//echo $sql_raw;die();
		$get_total = $CI->db->query($sql_raw)->result();
		$totalData = $get_total[0]->total;
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
		if ($custom_where!="") {
			$custom_where = " and ".$custom_where;
		}

		if (stripos($tbl_id, ".")){
			$tbl_id = explode('.', $tbl_id);
			$tbl_id = $tbl_id[1];
		}

		$sql = "SELECT ";
		for ($i=0; $i < count($columns) ; $i++) { 
			if ($i==(count($columns)-1)){
				$sql.=$columns[$i];
			}else{
				$sql.=$columns[$i].",";
			}
		}
		$sql.=" FROM ".$table_name." WHERE 1=1";
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			if (stripos($columns[0], " as ")) {
				$columns[0] = explode("as", $columns[0]);
				$columns[0] = trim($columns[$i][1]);
			}
			$sql.=" AND ( ".$columns[0]." LIKE '%".$requestData['search']['value']."%' ";    
			for ($i=1; $i < count($columns)-1 ; $i++) { 
				if (stripos($columns[$i], " as ")) {
					$columns[$i] = explode(" as ", $columns[$i]);
					$findData = trim($columns[$i][0]);
					$columns[$i] = trim($columns[$i][1]);
					
					$sql.=" OR ".$findData." LIKE '%".$requestData['search']['value']."%' ";
				}else{
					$sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' ";
				}
			}
			if (stripos($columns[count($columns)-1], " as ")) {
				$columns[count($columns)-1] = explode(" as ", $columns[count($columns)-1]);
				$columns[count($columns)-1] = trim($columns[count($columns)-1][0]);
				if ($columns[$i] == "amount_debet") {
					$findData = "amount";
				}elseif($columns[$i] == "amount_kredit"){
					$findData = "amount";
				}else{
					$findData = $columns[$i];
				}
				$sql.=" OR ".$findData." LIKE '%".$requestData['search']['value']."%' ";
				$sql .= ")";
			}else{
				$sql.=" OR ".$columns[count($columns)-1]." LIKE '%".$requestData['search']['value']."%' ) ";
			}
		}
		$sql.= $custom_where;


		if ($custom_group!="") {
			$sql .= " group by ".$custom_group;
		}
		//echo $sql;die();
		$query = $query_run = $CI->db->query($sql)->result();
		
		$totalFiltered = count($query);
		
		if ($custom_order!="") {
			$sql.= " ORDER BY ".$custom_order." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
		}else{
			if (strpos($columns[$requestData['order'][0]['column']], " as "))  {
				$getColumn = $columns[$requestData['order'][0]['column']];
				$getColumn = explode(" as ", $columns[$requestData['order'][0]['column']]);
				$columns[$requestData['order'][0]['column']] = $getColumn[1];
			}
			$sql.=" ORDER BY ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
		}
		//echo $sql;die();
		$query = $query_run = $CI->db->query($sql)->result();
		
		$data = array();
		$no = $requestData['start']+1;
		foreach ($query as $key => $value) {
			$nestedData=array();
		 	$nestedData[] = $no;
		 	$no++;
		 	
			for ($i=0; $i < count($columns); $i++) {
				$cek =array();
				if ($columns[$i]!==$hide_column) {
					if (strpos($columns[$i], " as ")) {
						$cek =  $columns[$i];
						$columns[$i] = explode(" as ", $columns[$i]);
						$columns[$i] = trim($columns[$i][1]);
					}

					if (stripos($columns[$i],".")) {
						$get = explode(".", $columns[$i]);
						$columns[$i] = trim($get[1]);
					}

					
					if (HlmHelper::validateDate($value->$columns[$i])) {
						$getDate = date_create($value->$columns[$i]);
						$value->$columns[$i] = date_format($getDate,'d/m/Y');
					}elseif ($value->$columns[$i]=="0000-00-00") {
						$value->$columns[$i] = "00/00/0000";
					}elseif ($value->$columns[$i]=="0000-00-00 00:00:00") {
						$value->$columns[$i] = "00/00/0000 00:00:00";
					}

					if (!empty($custom_field)) {
						foreach ($custom_field as $fieldName => $valChange) {
							if ($fieldName==$columns[$i]) {
								foreach ($valChange as $keyName => $newVal) {
									if ($value->$columns[$i]==$keyName) {
										$value->$columns[$i] = $newVal;
									}								
								}
							}
						}
					}

					if (count($custom_link)>0) {
						foreach ($custom_link as $field => $valField) {
							if ($field==$columns[$i]) {
								$value->$columns[$i] = "<a style='color:blue' href='".base_url().$valField.".".$value->$tbl_id."/".$requestMenu."'>".$value->$columns[$i]."</a>";
							}
						}
					}
					$nestedData[] = $value->$columns[$i];
				}
			}

			if ($custom_thick!="") {
				$nestedData[] ='<input type="checkbox" name="'.$custom_thick.'['.$value->$tbl_id.']" data_id="'.$custom_thick.'['.$value->$tbl_id.']">';
			}

			//custom filesize
			if ($custom=="majagemen") {
				$totalMegabytes = 0;
				$fileUploads = $CI->db->where('id_document',$value->id)->get('file_uploads')->result();
				$getOldata = $CI->db->where('id',$value->id)->get('documents')->result();
				$jumlahFile = 0;
				// foreach ($fileUploads as $keyFile => $valueFile) {
				// 	$fileLoc = "./data_uploads/documents/".$getOldata[0]->id_level_1."/".$valueFile->file_name;
				// 	$bytes = filesize($fileLoc);
		  //           $kilobytes = $bytes/1024;
		  //           $megabytes = $kilobytes/1024;
		  //           $totalMegabytes = $totalMegabytes + $megabytes;
		  //           $jumlahFile++;
				// }
				
	   //          $nestedData[] = round($totalMegabytes,2)." MB ($jumlahFile File)";
				$nestedData[] = round(10,2)." MB ($jumlahFile File)";
			}

			if ($custom=="unit") {
				$totalMegabytes = 0;
				$getKodeUnitKerja = $CI->db->where('id',$value->id)->get('unit_kerja')->result();

				$fileUploads = $CI->db->query('select d.id_level_1,d.kode_unit_kerja,fu.* from documents as d join file_uploads as fu on d.id = fu.id_document where d.kode_unit_kerja = "'.$getKodeUnitKerja[0]->kode_unit_kerja.'"')->result();
				$jumlahFile = 0;
				foreach ($fileUploads as $keyFile => $valueFile) {
					$fileLoc = "./data_uploads/documents/".$valueFile->id_level_1."/".$valueFile->file_name;
					$bytes = filesize($fileLoc);
		            $kilobytes = $bytes/1024;
		            $megabytes = $kilobytes/1024;
		            $totalMegabytes = $totalMegabytes + $megabytes;
		            $jumlahFile++;
				}
				
	            $nestedData[] = round($totalMegabytes,2)." MB ($jumlahFile File)";
			}
			//end custom filesize

			if (count($custom_if)>0) {
				$val = (key($custom_if));
				if ($value->$val==$custom_if[key($custom_if)]) {
					$link = "";
					foreach ($method_link as $key2 => $value2) {
						$tipe = "info";
						$del = "";
						if (stripos($icon_img[$key2],"_")) {
							$getTipe = explode("_", $icon_img[$key2]);
							$tipe = $getTipe[1];
							$icon = $getTipe[0];
							$describ = "";
							if (isset($getTipe[2])) {
								$describ = $getTipe[2];
							}

							if (stripos($tipe, 'anger') || stripos($tipe, 'arning')) {
								$del = "onclick='return confirm(\"Apakah anda yakin ?\")'";
							}
						}else{
							$icon = $icon_img[$key2];
						}
						if (stripos(" ".$value2, "Click")) {
							$value2 = str_replace("id",$value->$tbl_id, $value2);
							$link .= "<a ".$value2."  style='margin-right:0px' class='btn btn-".$tipe."' title='".$key2."' ><span class='".$icon."'></span> $describ</a>";
						}else{
							$link .= "<a style='margin-right:0px' class='btn btn-".$tipe."' href='".base_url().$value2."/".$value->$tbl_id."/' title='".$key2."' data-id='".$value->$tbl_id."/".$requestMenu."' ".$del." ><span class='".$icon."'></span> $describ</a>";
						}
						
					}
					if ($link!="") {
						$nestedData[] = $link;
					}else{
						$nestedData[] = "N/A";
					}
				}else{
					$nestedData[] = "N/A";
				}
			}elseif(empty($custom_if)){
				$link = "";
				foreach ($method_link as $key2 => $value2) {
					$tipe= "info";
					$del = "";
					$describ = "";
					if (stripos($icon_img[$key2],"_")) {
						$getTipe = explode("_", $icon_img[$key2]);
						$tipe = $getTipe[1];
						$icon = $getTipe[0];
						$describ = "";
						if (isset($getTipe[2])) {
							$describ = $getTipe[2];
						}

						if (stripos($tipe, 'anger') || stripos($tipe, 'arning')) {
							$del = "onclick='return confirm(\"Apakah anda yakin ?\")'";
						}
					}else{
						$icon = $icon_img[$key2];
					}
					if (stripos(" ".$value2, "onClick")) {
						$value2 = str_replace("id",$value->$tbl_id, $value2);
						$link .= "<a ".$value2."  style='margin-right:0px' class='btn btn-".$tipe."' title='".$key2."'><span class='".$icon."'></span> $describ</a>";
					}else{
						$link .= "<a style='margin:1px' class='btn btn-".$tipe."' href='".base_url().$value2.".".$value->$tbl_id."/".$requestMenu."' title='".$key2."' data-id='".$value->$tbl_id."' ".$del." ><span class='".$icon."'></span> $describ</a>";	
					}			
				}
				if ($link!="") {
					$nestedData[] = $link;
				}else{
					$nestedData[] = "N/A";
				}
			}else{
				$nestedData[] = "N/A";
			}
			$data[] = $nestedData;
		}

		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
					"recordsTotal"    => intval( $totalFiltered ),  // total number of records
					"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
					"data"            => $data   // total data array
					);

		echo json_encode($json_data);  // send data as json format
	}
	
	public function getQuery($params)
	{
		$query = array(
			'draw' => $params['draw'],
			'offset' => $params['start'],
			'limit' => $params['length'],
			'filter' => $params['search']['value'],
			'columns' => $params['columns'],
			'sortcolumn' => $params['order'][0]['column'],
			'sortdir' => $params['order'][0]['dir']
		);
		
		return $query;
	}

    public function auth()
    {
    	$CI =& get_instance();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        //JWT Auth middleware
        $headers = $CI->input->get_request_header('Authorization');
        $apiKey = $CI->input->get_request_header('x-api-key');

        $kunci = SALT; //secret key for encode and decode
        $token= "token";
       	if (!empty($headers) && !empty($apiKey)) {
        	if (preg_match('/Bearer\s(\S+)/', $headers , $matches)) {
            	$token = $matches[1];
        	}

        	if ($apiKey != '3dncu32823hrnfosjd7dshy728uebjsuwg2jefhfuhe') {
        		$CI->response(['error' => 'Invalid API KEY'], 401);//401
        	}
        	
    	}
        try {
           $decoded = JWT::decode($token, $kunci, array('HS256'));
           $CI->user_data = $decoded;
        } catch (Exception $e) {
            $invalid = ['error' => $e->getMessage()]; //Respon if credential invalid
            $CI->response($invalid, 401);//401
        }
    }
}
