<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('commonfunction'))
{
    function commonfunction($params)
    {
        //Your code here
    }
}

if (!function_exists('validateDate'))
{
    function validateDate($params)
    {
        if (stripos($date,":")) {
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
            $format = "Y-m-d H:i:s";
        } else {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            $format = "Y-m-d";
        }
        return $d && ($d->format($format) === $date) ;          
    }
}

if (!function_exists('debug'))
{
    function debug($data){
    	echo "<pre>";
        print_r($data);
        echo "</pre>";
    	die();
    }
}

if (!function_exists('checkSession'))
{
    function checkSession($id) {
        $CI =& get_instance();
        if ($CI->session->userdata($id)) return true;
        return false;
    }
}

if (!function_exists('setAlert'))
{
    /**
     * @param type String enum warning, default, danger, info, success
     * @param message String 
     */
    function setAlert($type, $message) {
        $CI =& get_instance();
        $CI->session->set_flashdata('alert', true);
        $CI->session->set_flashdata('alerttype', $type);
        $CI->session->set_flashdata('alertmessage', $message);
    }
}

if (!function_exists('getRandomHTMLId'))
{
    /**
     * @param Array existing id
     * @return String html random id
     */
    function getRandomHTMLId($ex) {
        
    }
}

if (!function_exists('getUserId'))
{
    function getUserId() {
        $CI =& get_instance();
        return $CI->session->userdata('id');
    }
}

if (!function_exists('getStoreId'))
{
    function getStoreId() {
        $CI =& get_instance();
        return $CI->session->userdata('store');
    }
}

if (!function_exists('getGroupStoreId'))
{
    function getGroupStoreId() {
        $CI =& get_instance();
        return $CI->session->userdata('groupstore');
    }
}

if (!function_exists('getGroupStoreType'))
{
    function getGroupStoreType() {
        $CI =& get_instance();
        return $CI->session->userdata('groupstoretype');
    }
}

if (!function_exists('isDeptStore'))
{
    function isDeptStore() {
        $CI =& get_instance();
        $t = $CI->session->userdata('groupstoretype');
        $isdept = $t == 1 ? true : false;
        return $isdept;
    }
}

if (!function_exists('getUserName'))
{
    function getUserName() {
        $CI =& get_instance();
        return $CI->session->userdata('username');
    }
}

if (!function_exists('getSupplierId'))
{
    function getSupplierId() {
        $CI =& get_instance();
        return $CI->session->userdata('supplier');
    }
}

if (!function_exists('getWarehouseId'))
{
    function getWarehouseId() {
        $CI =& get_instance();
        return $CI->session->userdata('warehouse');
    }
}

if (!function_exists('getGroupName'))
{
    function getGroupName() {
        $CI =& get_instance();
        return $CI->session->userdata('groupname');
    }
}

if (!function_exists('checkGroupAccess'))
{
    function checkGroupAccess($group) {
        $CI =& get_instance();
        if ($CI->session->userdata('groupname') == $group) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getTimestamp'))
{
    function getTimestamp() {
        return date("Y-m-d H:i:s", time());
    }
}

/**
 * action: check exist key in array
 */
if (!function_exists('checkExist'))
{
    function checkExist($array, $key) {
        return in_array($key, $array);
    }
}

/**
 * action: set json response
 */
if (!function_exists('returnJson'))
{
    function returnJson($response) {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

if (!function_exists('convertToObject'))
{
    function convertToObject($array) {
        $object = new stdClass();
        foreach ($array as $key => $value)
        {
            $object->$key = $value;
        }
        return $object;
    }
}

