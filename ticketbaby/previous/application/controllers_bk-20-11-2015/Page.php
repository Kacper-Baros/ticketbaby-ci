<?php
class Page extends CI_Controller {

    public function view($page = 'home')
    {
	

		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
    }
	// Start Function for page 
	public function loadPage($slug)
    {
		$this->load->model('page_model');
    	
		$content_page  = $this->page_model->get_page_by_slug($slug);
        if($content_page) {
				$data['content_page'] =  $content_page;
			
				/*if (file_exists(APPPATH."views/pages/{$slug}.php"))
                {*/
                 	
					
					$data['title'] = ucfirst($slug); // Capitalize the first letter
					$slug	=	"page";
					
					$this->load->view('templates/header', $data);
					$this->load->view('pages/'.$slug, $data);
					$this->load->view('templates/footer', $data);
               /* }
                else
                    show_404();*/
            } else {
				      show_404();
           }
    }
}