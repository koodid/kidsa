<?php
class Blog extends CI_Controller {

        public function index()
        {
				$title['title'] = 'Veebirakendus blog';
                $this->load->view('navbar', $title);
        }
		
		public function comments()
        {
                echo 'class Blog -> Look at this!';
        }
		
		public function shoes($sandals, $id)
        {
                echo $sandals;
                echo $id;
        }
}