<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class ModelController extends CI_Controller {

    protected $modelOptions;
    
    /**
     * Contruct with options class
     * @param options Array
     */
    public function __construct($options)
    {
        // Check Options Class Validation
        extract($options);
        if (!isset($modulename)
            || !isset($route)
            || !isset($tablename)
        ) {
            throw New Exception('Check Model Requirement');
        }

        $this->modelOptions = $options;        
        parent::__construct();

        // Session
        $CI =& get_instance();
        if (!$CI->session->userdata('authLogin')) {
            redirect('auth', 'refresh');
        }

        // Check Access    
        $listAccess = $CI->session->userdata('access');
        if (!in_array(strtoupper($options['access']), $listAccess)) {
            // echo 'NO_ACCESS';die;
            setAlert('warning', 'Anda tidak memiliki Akses');
            redirect('home');
        }
    }

    /**
     * Redirect index to view method
     * @param params Array
     */
    public function index($params = array())
    {
        $this->view($params);
    }

    /**
     * Redirect to Main View Page 
     * @param params Array
     */
    public function view($params = array())
    {    
        extract($this->modelOptions);
        $params['route'] = $route;
        $params['activemenu'] = $modulename;
        $params['pagetitle'] = $modulename;
        $params['modulename'] = $modulename;
        $params['breadcrumb'] = array(
            $modulename => base_url().$route
        );
        $params['modelfield'] = $modelfield;
        $page = 'model/view';
        if (array_key_exists('view', $this->modelOptions)) {
            $v = $this->modelOptions['view'];
            if (array_key_exists('view', $v)) {
                $page = $v['view'];
            }
        }
        $this->view->genView($page, $params);
    }

    /**
     * Redirect to Create Page
     * @param params Array
     */
    public function create($params = array())
    {
        $params = $this->_getParamsCreate();
        $page = 'model/create';
        if (array_key_exists('view', $this->modelOptions)) {
            $v = $this->modelOptions['view'];
            if (array_key_exists('create', $v)) {
                $page = $v['create'];
            }
        }
        $this->view->genView($page, $params);
    }

    /**
     * Default Params for Detail / Edit Page
     */
    public function _getParamsDetail($id)
    {
        extract($this->modelOptions);
        $model = $this->modelOptions;
        $getDetailData = $this->db->query("SELECT * from ".$model['tablename']." where id =".$id)->result_array();
        if (empty($getDetailData)) {
            // throw not found
        }

        $params = array();        
        $params['modeloptions'] = $this->modelOptions;
        $referenceValues = array();
        foreach ($this->modelOptions['modelfield'] as $key => $value) {
            if (array_key_exists('reference', $value)) {
                $ref = $value['reference'];
                $source = 'name';
                if (array_key_exists('source_key', $value)) $source = $value['source_key'];
                $getValues = $this->db->query('SELECT * from '.$ref['table_name'].' where is_delete = 0 ORDER by '.$source.' ASC')->result_array();
                $referenceValues[$key] = $getValues;
            }

            if (array_key_exists('values', $value)) {
                $referenceValues[$key] = $value['values'];
            }

            if (count($referenceValues) > 0) $params['referencevalues'] = $referenceValues;
        }
        $params['activemenu'] = $model['modulename'];
        $params['modulename'] = $model['modulename'];
        $params['pagetitle'] = 'Detail '.$model['modulename'];
        $params['breadcrumb'] = array(
            $modulename => base_url().$route,
            'Detail '.$modulename => ''
        );
        if (isset($parentmenu)) $params['parentmenu'] = $parentmenu;
        $params['data'] = array_shift($getDetailData);
        return $params;
    }

    /**
     * Default Params for Create Page
     */
    public function _getParamsCreate()
    {
        extract($this->modelOptions);
        $model = $this->modelOptions;

        $params['modeloptions'] = $this->modelOptions;
        $referenceValues = array();
        $mapValues = array();
        foreach ($this->modelOptions['modelfield'] as $key => $value) {
            if (array_key_exists('reference', $value)) {
                $ref = $value['reference'];
                if (array_key_exists('type', $ref) && $ref['type'] == 'reference_table') {
                    $getValues = $this->db->query('SELECT * from '.$ref['table_name'].' where is_delete = 0')->result_array();
                    $referenceValues[$key] = $getValues;

                    $getMap = $this->db->query('SELECT * from '.$ref['reference_table'].' order by id ASC')->result_array();
                    $mapValues[$key] = $getMap;
                } elseif ((array_key_exists('type', $ref) && $ref['type'] == 'master_table') || !array_key_exists('type', $ref)) {
                    $source = 'name';
                    if (array_key_exists('source_key', $ref)) $source = $ref['source_key'];

                    $getValues = $this->db->query('SELECT * from '.$ref['table_name'].' where is_delete = 0 ORDER by '.$source.' ASC')->result_array();
                    $referenceValues[$key] = $getValues;
                }               
            }

            if (array_key_exists('values', $value)) {
                $referenceValues[$key] = $value['values'];
            }

            if (count($referenceValues) > 0) $params['referencevalues'] = $referenceValues;
            if (count($mapValues) > 0) $params['mapValues'] = $mapValues;
        }
        
        $params['activemenu'] = $model['modulename'];
        $params['pagetitle'] = 'Create New '.$model['modulename'];
        $params['modulename'] = $model['modulename'];
        $params['breadcrumb'] = array(
            $modulename => base_url().$route,
            'Create new '.$modulename => ''
        );
        if (isset($parentmenu)) $params['parentmenu'] = $parentmenu;
        return $params;
    }

    /**
     * Redirect to Detail Page
     * @param id String
     */
    public function detail($id, $readonly = true)
    {
        $params = $this->_getParamsDetail($id);
        $params['readonly'] = $readonly;
        $page = 'model/detail';
        if (array_key_exists('view', $this->modelOptions)) {
            $v = $this->modelOptions['view'];
            if (array_key_exists('detail', $v)) {
                $page = $v['detail'];
            }
        }
        return $this->view->genView($page, $params);
    }

    /**
     * Redirect to Edit Page
     * @param id String
     */
    public function update($id)
    {
        $this->detail($id, false);
    }

    /**
     * Redirect to Delete Action
     * @param id String
     */
    public function delete($id)
    {        
        $this->action('delete', array('id' => $id));
    }

    /**
     * @param payload POST variabel
     * @param model model options
     */
    public function saveModel($payload, $model)
    {
        $payload['created_by'] = getUserId();
        $this->db->insert($model['tablename'], $payload);
        $insertedId = $this->db->insert_id();
        $payload['id'] = $insertedId;
        setAlert('success', $model['modulename'].' Created');
        return $payload;
    }

    public function beforeSave($payload, $model) {
        return $payload;
    }

    public function afterSave($payload, $model) {
        return $payload;
    }

    /**
     * @param payload POST variabel
     * @param model model options
     */
    public function updateModel($payload, $model)
    {
        $this->db->where('id', $payload['id']);
        $this->db->update($model['tablename'], $payload);
        setAlert('success', $model['modulename'].' Updated');
        return $payload;
    }

    public function beforeUpdate($payload, $model) {
        return $payload;
    }

    public function afterUpdate($payload, $model) {
        return $payload;
    }

    /**
     * @param payload POST variabel
     * @param model model options
     */
    public function deleteModel($payload, $model)
    {
        $id = $payload['id'];
        $this->db->where('id', $id);
        $dataToUpdate = array(
            'is_delete' => 1
        );
        $this->db->update($model['tablename'], $dataToUpdate);
        setAlert('success', $model['modulename'].' Deleted');
    }


    public function beforeDelete($payload, $model){
        return $payload;
    }

    public function afterDelete($payload, $model){
        return $payload;
    }

    /**
     * Action Method
     * @param actionMode String
     */
    public function action($actionMode, $params = array())
    {
        $model = $this->modelOptions;
        $payload = $this->input->post();
        try {
            switch ($actionMode) {
                case 'save':
                    // Check Access
                    $payload = $this->beforeSave($payload, $model);
                    $payload = $this->saveModel($payload, $model);
                    $payload = $this->afterSave($payload, $model);
                    break;
                case 'edit':
                    // Check Access                    
                    $payload = $this->beforeUpdate($payload, $model);
                    $payload = $this->updateModel($payload, $model);
                    $payload = $this->afterUpdate($payload, $model);
                    break;
                case 'delete':
                    // Check Access
                    $payload = $this->beforeDelete($params, $model);
                    $payload = $this->deleteModel($params, $model);
                    $payload = $this->afterDelete($params, $model);
                    break;
                default:
                    # code...
                    break;
            }
            redirect($model['route'].'/view');
        } catch (Exception $err) {
            setAlert('warning', $err->getMessage());
            redirect($_SERVER['HTTP_REFERER']);
        }        
    }

    /**
     * Ajax Request for datatables
     * @param invoke String
     */
    public function ajaxRequest($invoke = "get") 
    {
        /**
         * Add Validation for API request only
         */
        if ($invoke === "") return "Invocation Type Required";
        $invokeType = strtolower($invoke);
        $params = $this->input->get();
        $query = $this->datatables->getQuery($params);
        $model = $this->options;
        $table = $model['tablename'];        
        extract($query);
        $where = 1;
        $order = '';

        $column = array();

        $joinQuery = "";
        $columnQuery = array();
        // generate column & joinQuery
        foreach ($model['modelfield'] as $key => $value) {            
            if (array_key_exists('columnview', $value) && $value['columnview'] == true && !array_key_exists('reference', $value)) {
                array_push($columnQuery, $table.'.'.$key);
                array_push($column, $key);
            } elseif (array_key_exists('columnview', $value) && $value['columnview'] == true && array_key_exists('reference', $value)) {
                $ref = $value['reference'];
                $source = array_key_exists('source_key', $ref) ? $ref['source_key'] : 'name';
                array_push($columnQuery, $ref['table_name'].'.'.$source.' AS '.$ref['alias']);
                array_push($column, $ref['alias']);
                $joinQuery = $joinQuery.' JOIN '.$ref['table_name'].' ON '.$table.'.'.$ref['foreign_key'].' = '.$ref['table_name'].'.id';
            }
        }

        // fix this
        if (array_key_exists('filter', $query)) {
            $key = $query['filter'];
            $condition = array();
            foreach ($this->options['modelfield'] as $k => $v) {
                if (array_key_exists('columnview', $v) && $v['columnview'] == true && !array_key_exists('reference', $v)) {
                    array_push($condition, $table.'.'.$k.' like "%'.$key.'%" ');
                } elseif (array_key_exists('columnview', $v) && $v['columnview'] == true && array_key_exists('reference', $v)) {
                    $ref = $v['reference'];
                    $source = array_key_exists('source_key', $ref) ? $ref['source_key'] : 'name';
                    array_push($condition, $ref['table_name'].'.'.$source.' like "%'.$key.'%" ');
                }
            }
            $where = ' ('.join(" OR ", $condition).') ';
        }

        // fix this
        if (array_key_exists('sortcolumn', $query)) {
            if ($query['sortcolumn'] != 0) {
                $order = ' ORDER BY '.$column[$query['sortcolumn'] -1].' '.$query['sortdir'];            
            } else {
                $order = " ORDER BY $table.id DESC";
            }
        }
        
        switch ($invokeType) {
            case 'get':
                $queryColumn = join(',', $columnQuery);
                $queryColumn = $queryColumn. ",".$table.'.id';
                $join = '';
                $sql = "SELECT $queryColumn FROM $table $joinQuery WHERE $table.`is_delete` = 0 AND $where $order";
                $allData = $this->db->query($sql)->num_rows();
                $sql .= " LIMIT $limit OFFSET $offset";
                $user = $this->db->query($sql);
                $limitData = $user->num_rows();
                
                $data = array();
                $no = $offset + 1;
                foreach($user->result() as $r) {
                    $res = array($no);                    
                    foreach ($column as $key => $value) {
                        $f = explode('.', $value);
                        $fieldname = end($f);
                        array_push($res, $r->$fieldname);
                    }
                    array_push($res, $r->id);
                    $data[] = $res;
                    $no++;
               }
     
                $output = array(
                    'data' => $data,
                    'draw' => $draw,
                    "recordsTotal" => $allData,
                    "recordsFiltered" => $allData,
                );
                echo json_encode($output);
                exit();
                break;
            /**
             * Add New Case To Register New Query Invocation
             */
            default:
                return "Invocation Type Not Registered";
                break;
        }
    }

}