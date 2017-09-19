<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
    public function __construct() {

        parent::__construct();

    }

    public function iface($strInterfaceName) {

        require_once APPPATH . '/interfaces/' . $strInterfaceName . '.php';

    }
}
/* End of file MY_Loader.php */
/* Location: ./application/core/MY_Loader.php */