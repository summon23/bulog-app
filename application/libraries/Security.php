<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security {

    /**
     * RBAC - checkpermission
     * check permission by user and combination of access (idMenu.idSubMenu.accessGrant)
     * @param user Array
     * @param access String
     * @return true/false
     */
    public function checkPermission($user, $access)
    {
        $CI =& get_instance();
        $userId = $user->id;
        $accessPoint = explode($access, '.');
        $idMenu = $accessPoint[0];
        $idSubMenu = $accessPoint[1];
        $accessGrant = $accessPoint[2];

        $getPermission = $CI->db->query("SELECT * from user_priviledge where id_menu=$idMenu AND id_submenu=$idSubMenu AND access_grant=$accessGrant AND id_user=$userId");
        if (empty($getPermission)) {
            return false;
        }
        return true;
    }

    /**
     * Security Input
     * Xss Cleanup
     */
    public function cleanupData($data)
    {
        $CI =& get_instance();
        $CI->load->library('security');
        $data = $this->security->xss_clean($data);
        return $data;
    }
}