<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Social_auth extends MY_Shop_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function endpoint()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $_GET = $_REQUEST;
        }
        require_once FCPATH . 'vendor/hybridauth/hybridauth/hybridauth/index.php';
    }

    public function index()
    {
        redirect('/');
    }

    public function login($provider = null)
    {
        if ($this->input->get('hauth_done')) {
            $provider = $this->input->get('hauth_done');
        }
        $this->config->set_item('provider', $provider);
        $this->load->library('HybridAuthLib', $provider);

        if ($this->hybridauthlib->providerEnabled($provider)) {
            $service = $this->hybridauthlib->authenticate($provider);

            try {
                // $accessToken = $service->getAccessToken();
                $user_profile = $service->getUserProfile();
                $service->disconnect();

                $this->lang->admin_load('auth');
                $this->load->admin_model('auth_model');
                $this->load->library('ion_auth');

                if ($user = $this->shop_model->getUserByEmail($user_profile->email)) {
                    if ($user->active < 1) {
                        $this->session->set_flashdata('error', lang('login_unsuccessful_not_active'));
                        redirect('login');
                    }
                    $this->session->set_flashdata('message', lang('login_successful'));
                    $this->auth_model->update_last_login($user->id);
                    $this->auth_model->update_last_login_ip($user->id);
                    $this->auth_model->set_session($user);
                } else {
                    $this->load->helper('string');

                    $email    = $username    = $user_profile->email;
                    $password = random_string('alnum', 8);

                    $customer_group = $this->shop_model->getCustomerGroup($this->Settings->customer_group);
                    $price_group    = $this->shop_model->getPriceGroup($this->Settings->price_group);

                    $company_data = [
                        'company'             => '-',
                        'name'                => $user_profile->firstName . ' ' . $user_profile->lastName,
                        'email'               => $user_profile->email,
                        'group_id'            => 3,
                        'group_name'          => 'customer',
                        'customer_group_id'   => (!empty($customer_group)) ? $customer_group->id : null,
                        'customer_group_name' => (!empty($customer_group)) ? $customer_group->name : null,
                        'price_group_id'      => (!empty($price_group)) ? $price_group->id : null,
                        'price_group_name'    => (!empty($price_group)) ? $price_group->name : null,
                    ];

                    $company_id = $this->shop_model->addCustomer($company_data);

                    $additional_data = [
                        'first_name' => $user_profile->firstName,
                        'last_name'  => $user_profile->lastName,
                        'gender'     => $user_profile->gender,
                        'company_id' => $company_id,
                        'group_id'   => 3,
                    ];

                    if ($this->ion_auth->register($username, $password, $email, $additional_data, true, true)) {
                        if ($this->ion_auth->login($email, $password)) {
                            if ($this->Settings->mmode) {
                                if (!$this->sma->in_group('owner')) {
                                    $this->session->set_flashdata('error', lang('site_is_offline_plz_try_later'));
                                    redirect('logout');
                                }
                            }

                            $this->session->set_flashdata('message', $this->ion_auth->messages());
                            $referrer = $this->session->userdata('requested_page') ? $this->session->userdata('requested_page') : '/';
                            redirect($referrer);
                        } else {
                            $this->session->set_flashdata('error', lang('user_login_failed') . ' ' . $this->ion_auth->errors());
                            redirect('login');
                        }
                    } else {
                        $this->session->set_flashdata('error', lang('user_registeration_failed') . ' ' . $this->ion_auth->errors());
                        redirect('login');
                    }
                }
                redirect('/');
            } catch (Hybridauth\Exception\HttpClientFailureException $e) {
                log_message('error', 'Curl text error message : ' . $service->getHttpClient()->getResponseClientError());
                $this->session->set_flashdata('error', lang('error_authenticating_user') . $service->getHttpClient()->getResponseClientError());
                redirect('login');
            } catch (Hybridauth\Exception\HttpRequestFailedException $e) {
                log_message('error', 'Raw API Response: ' . $service->getHttpClient()->getResponseBody());
                $this->session->set_flashdata('error', lang('error_authenticating_user') . $service->getHttpClient()->getResponseBody());
                redirect('login');
            } catch (\Exception $e) {
                log_message('error', 'Oops! We ran into an unknown issue: ' . $e->getMessage());
                $this->session->set_flashdata('error', lang('error_authenticating_user') . $e->getMessage());
                redirect('login');
            }
        } else {
            log_message('error', 'controllers.HAuth.login: This provider is not enabled (' . $provider . ')');
            show_404($_SERVER['REQUEST_URI']);
        }
    }
}
