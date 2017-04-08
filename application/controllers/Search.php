<?php
class Search extends CI_Controller
{
    public function index()
    {
        $this->load->model('Post');
        $results = $this->Post->searchPosts($this->input->post('searchField'));
        $data['search_results'] = $results;
        if (empty($results))
        {
            $data['noResults'] = 1;
        } else {
            $data['noResults'] = 0;
        }
        $title['title'] = lang("msg_searchpage");
        $this->load->view('navbar', $title);
        $this->load->view('search', $data);
        $this->load->view('footer');
    }
}