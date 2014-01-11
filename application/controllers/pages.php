<?php

/**
 * Class Pages
 *
 * Use http://localhost/tnttry/index.php/{page_name} to render pages
 */

class Pages extends CI_Controller {
    public function view($page = 'home')
    {
        if ( ! file_exists('application/views/pages/'.$page.'.php'))
        {
            show_404();
        }

        $this->load->library('login');

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['login_tpl'] = $this->login->index();
        $data['reg_tpl'] = $this->load->view('pages/registration', $data, TRUE);

        $this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}