<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Curl Class
 *
 * Work with remote servers via cURL much easier than using the native PHP bindings.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Philip Sturgeon
 * @license         http://philsturgeon.co.uk/code/dbad-license
 * @link			http://getsparks.org/packages/curl/show
 */
class Curl
{
    public $error_code;		 // Error code returned as an int
    public $error_string;	   // Error message returned as a string
    public $info;			   // Returned after request (elapsed time, etc)

    private $_ci;				// CodeIgniter instance
    private $headers  = []; // Populates extra HTTP headers
    private $options  = []; // Populates curl_setopt_array
    private $response = '';		  // Contains the cURL response for debug
    private $session;		   // Contains the cURL handler for a session
    private $url;			   // URL of the session

    public function __construct($url = '')
    {
        $this->_ci = &get_instance();
        log_message('debug', 'cURL Class Initialized');

        if (!$this->is_enabled()) {
            log_message('error', 'cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.');
        }

        $url and $this->create($url);
    }

    /* =================================================================================
     * SIMPLE METHODS
     * Using these methods you can make a quick and easy cURL call with one line.
     * ================================================================================= */

    public function _simple_call($method, $url, $params = [], $options = [])
    {
        // Get acts differently, as it doesnt accept parameters in the same way
        if ($method === 'get') {
            // If a URL is provided, create new session
            $this->create($url . ($params ? '?' . http_build_query($params) : ''));
        } else {
            // If a URL is provided, create new session
            $this->create($url);

            $this->{$method}($params);
        }

        // Add in the specific options provided
        $this->options($options);

        return $this->execute();
    }

    // Start a session from a URL
    public function create($url)
    {
        // If no a protocol in URL, assume its a CI link
        if (!preg_match('!^\w+://! i', $url)) {
            $this->_ci->load->helper('url');
            $url = site_url($url);
        }

        $this->url     = $url;
        $this->session = curl_init($this->url);

        return $this;
    }

    public function debug()
    {
        echo "=============================================<br/>\n";
        echo "<h2>CURL Test</h2>\n";
        echo "=============================================<br/>\n";
        echo "<h3>Response</h3>\n";
        echo '<code>' . nl2br(htmlentities($this->response)) . "</code><br/>\n\n";

        if ($this->error_string) {
            echo "=============================================<br/>\n";
            echo '<h3>Errors</h3>';
            echo '<strong>Code:</strong> ' . $this->error_code . "<br/>\n";
            echo '<strong>Message:</strong> ' . $this->error_string . "<br/>\n";
        }

        echo "=============================================<br/>\n";
        echo '<h3>Info</h3>';
        echo '<pre>';
        print_r($this->info);
        echo '</pre>';
    }

    public function debug_request()
    {
        return [
            'url' => $this->url,
        ];
    }

    public function delete($params, $options = [])
    {
        // If its an array (instead of a query string) then format it correctly
        if (is_array($params)) {
            $params = http_build_query($params, null, '&');
        }

        // Add in the specific options provided
        $this->options($options);

        $this->http_method('delete');

        $this->option(CURLOPT_POSTFIELDS, $params);
    }

    // End a session and return the results
    public function execute()
    {
        // Set two default options, and merge any extra ones in
        if (!isset($this->options[CURLOPT_TIMEOUT])) {
            $this->options[CURLOPT_TIMEOUT] = 30;
        }
        if (!isset($this->options[CURLOPT_RETURNTRANSFER])) {
            $this->options[CURLOPT_RETURNTRANSFER] = true;
        }
        if (!isset($this->options[CURLOPT_FAILONERROR])) {
            $this->options[CURLOPT_FAILONERROR] = true;
        }

        // Only set follow location if not running securely
        if (!ini_get('safe_mode') && !ini_get('open_basedir')) {
            // Ok, follow location is not set already so lets set it to true
            if (!isset($this->options[CURLOPT_FOLLOWLOCATION])) {
                $this->options[CURLOPT_FOLLOWLOCATION] = true;
            }
        }

        if (!empty($this->headers)) {
            $this->option(CURLOPT_HTTPHEADER, $this->headers);
        }

        $this->options();

        // Execute the request & and hide all output
        $this->response = curl_exec($this->session);
        $this->info     = curl_getinfo($this->session);

        // Request failed
        if ($this->response === false) {
            $this->error_code   = curl_errno($this->session);
            $this->error_string = curl_error($this->session);

            curl_close($this->session);
            $this->set_defaults();

            return false;
        }

        // Request successful
        else {
            curl_close($this->session);
            $response = $this->response;
            $this->set_defaults();
            return $response;
        }
    }

    public function http_header($header, $content = null)
    {
        $this->headers[] = $content ? $header . ': ' . $content : $header;
    }

    public function http_login($username = '', $password = '', $type = 'any')
    {
        $this->option(CURLOPT_HTTPAUTH, constant('CURLAUTH_' . strtoupper($type)));
        $this->option(CURLOPT_USERPWD, $username . ':' . $password);
        return $this;
    }

    public function http_method($method)
    {
        $this->options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
        return $this;
    }

    public function is_enabled()
    {
        return function_exists('curl_init');
    }

    public function option($code, $value)
    {
        if (is_string($code) && !is_numeric($code)) {
            $code = constant('CURLOPT_' . strtoupper($code));
        }

        $this->options[$code] = $value;
        return $this;
    }

    public function options($options = [])
    {
        // Merge options in with the rest - done as array_merge() does not overwrite numeric keys
        foreach ($options as $option_code => $option_value) {
            $this->option($option_code, $option_value);
        }

        // Set all options provided
        curl_setopt_array($this->session, $this->options);

        return $this;
    }

    /* =================================================================================
     * ADVANCED METHODS
     * Use these methods to build up more complex queries
     * ================================================================================= */

    public function post($params = [], $options = [])
    {
        // If its an array (instead of a query string) then format it correctly
        if (is_array($params)) {
            $params = http_build_query($params, null, '&');
        }

        // Add in the specific options provided
        $this->options($options);

        $this->http_method('post');

        $this->option(CURLOPT_POST, true);
        $this->option(CURLOPT_POSTFIELDS, $params);
    }

    public function proxy($url = '', $port = 80)
    {
        $this->option(CURLOPT_HTTPPROXYTUNNEL, true);
        $this->option(CURLOPT_PROXY, $url . ':' . $port);
        return $this;
    }

    public function proxy_login($username = '', $password = '')
    {
        $this->option(CURLOPT_PROXYUSERPWD, $username . ':' . $password);
        return $this;
    }

    public function put($params = [], $options = [])
    {
        // If its an array (instead of a query string) then format it correctly
        if (is_array($params)) {
            $params = http_build_query($params, null, '&');
        }

        // Add in the specific options provided
        $this->options($options);

        $this->http_method('put');
        $this->option(CURLOPT_POSTFIELDS, $params);

        // Override method, I think this overrides $_POST with PUT data but... we'll see eh?
        $this->option(CURLOPT_HTTPHEADER, ['X-HTTP-Method-Override: PUT']);
    }

    public function set_cookies($params = [])
    {
        if (is_array($params)) {
            $params = http_build_query($params, null, '&');
        }

        $this->option(CURLOPT_COOKIE, $params);
        return $this;
    }

    public function simple_ftp_get($url, $file_path, $username = '', $password = '')
    {
        // If there is no ftp:// or any protocol entered, add ftp://
        if (!preg_match('!^(ftp|sftp)://! i', $url)) {
            $url = 'ftp://' . $url;
        }

        // Use an FTP login
        if ($username != '') {
            $auth_string = $username;

            if ($password != '') {
                $auth_string .= ':' . $password;
            }

            // Add the user auth string after the protocol
            $url = str_replace('://', '://' . $auth_string . '@', $url);
        }

        // Add the filepath
        $url .= $file_path;

        $this->option(CURLOPT_BINARYTRANSFER, true);
        $this->option(CURLOPT_VERBOSE, true);

        return $this->execute();
    }

    public function ssl($verify_peer = true, $verify_host = 2, $path_to_cert = null)
    {
        if ($verify_peer) {
            $this->option(CURLOPT_SSL_VERIFYPEER, true);
            $this->option(CURLOPT_SSL_VERIFYHOST, $verify_host);
            $this->option(CURLOPT_CAINFO, $path_to_cert);
        } else {
            $this->option(CURLOPT_SSL_VERIFYPEER, false);
        }
        return $this;
    }

    private function set_defaults()
    {
        $this->response     = '';
        $this->headers      = [];
        $this->options      = [];
        $this->error_code   = null;
        $this->error_string = '';
        $this->session      = null;
    }

    public function __call($method, $arguments)
    {
        if (in_array($method, ['simple_get', 'simple_post', 'simple_put', 'simple_delete'])) {
            // Take off the "simple_" and past get/post/put/delete to _simple_call
            $verb = str_replace('simple_', '', $method);
            array_unshift($arguments, $verb);
            return call_user_func_array([$this, '_simple_call'], $arguments);
        }
    }
}

/* End of file Curl.php */
/* Location: ./application/libraries/Curl.php */
