<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once __DIR__ . '/../libraries/Facebook/autoload.php';
require_once __DIR__ . '/../config/secret_config.php';

class Fb_login_callback extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function fb_login_callback($uri = '')
    {
        $fb = new Facebook\Facebook([
            'app_id' => FACEBOOK_APP_ID,
            'app_secret' => FACEBOOK_APP_SECRET,
            'default_graph_version' => 'v2.5',
            'pseudo_random_string_generator' => 'openssl',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (isset($accessToken)) {
            // Logged in!
            $_SESSION['facebook_access_token'] = (string)$accessToken;

            // OAuth 2.0 client handler
            $oAuth2Client = $fb->getOAuth2Client();

            // Exchanges a short-lived access token for a long-lived one
            $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

            // Now you can redirect to another page and use the
            // access token from $_SESSION['facebook_access_token']
//            echo "Logged in successfully " . $accessToken;
//            echo "<br>" . $longLivedAccessToken;
//            echo "<br>";

            // Sets the default fallback access token so we don't have to pass it to each request
            $fb->setDefaultAccessToken($longLivedAccessToken);

            try {
                $response = $fb->get('/me?fields=name,email,id');
                $userNode = $response->getGraphUser();
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

//            echo 'Logged in as ' . $userNode->getName();
//            echo "<br>";
//            echo $userNode->asJson();


            $this->load->model('Register_model');
            if ($this->user->authenticate_fb_user($userNode->getId(), $userNode->getName(), $userNode->getField("email"))) {
                if ($uri === '') {
                    redirect('home');
                } else {
                    redirect($uri);
                }
            }
        }
        // TODO test else if auth rejected
    }
}