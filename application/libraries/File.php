<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File {
    public function upload($options = array())
    {
        $CI =& get_instance();

        try {
            if (!array_key_exists('path', $options) ||
            !array_key_exists('filename', $options) ||
            !array_key_exists('filetoupload', $options)){
                throw new Exception('Options Failure, Please check all options requirment');
            }

            $config['upload_path']          = './documents/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['file_name'] = $options['filename'];
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $CI->load->library('upload', $config);
            // debug($_FILES['file']);
            if (!$CI->upload->do_upload('file')){
                $error = array('error' => $CI->upload->display_errors());
                return $error;
            }
            $data = array('upload_data' => $CI->upload->data());
            // $this->load->view('upload_success', $data);
            return $data;
            // return json_encode($data);
        } catch (Exception $e) {
            throw $e;
        }
       
    }

    public function download($options = array())
    {
        
    }
}