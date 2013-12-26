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

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $header_template = ($page == 'admin') ? 'header_admin':'header';
        $footer_template = ($page == 'admin') ? 'footer_admin':'footer';

        $this->load->helper('url');

        $this->load->view('templates/'.$header_template, $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/'.$footer_template, $data);
    }
}