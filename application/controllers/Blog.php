<?php
class Blog extends CI_Controller {

        public function index()
        {
                echo 'class Blog -> Hello World!';
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