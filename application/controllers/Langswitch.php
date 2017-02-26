<?php

class LangSwitch extends CI_Controller
{
    public function switchLanguage($language = "")
    {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url() . trim($_GET['uri'], "/"));
    }
}