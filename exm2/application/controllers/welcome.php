<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('figura');
    }

    public function index() {
        $data['figuras'] = [
            'cuadrado' => Figura::crear("cuadrado", 5),
            'triangulo' => Figura::crear("triangulo", ['base' => 10, 'altura' => 10]),
            'circulo' => Figura::crear("circulo", 5),
        ];
        $this->load->view('welcome_message', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */