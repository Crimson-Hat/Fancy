<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Copyright:  Tecdiary IT Solutions
 *  ==============================================================================
 */

class Attachments
{
    public function __construct($config)
    {
        $this->path     = $config['path'];
        $this->types    = $config['types'];
        $this->max_size = $config['max_size'];
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function upload()
    {
        $attachments = [];
        if ($_FILES['attachments']['name'][0] != '') {
            $this->load->library('upload');
            $config = [
                'max_filename'  => 25,
                'encrypt_name'  => true,
                'overwrite'     => false,
                'upload_path'   => $this->path,
                'allowed_types' => $this->types,
                'max_size'      => $this->max_size,
            ];

            $files = $_FILES;
            $cpt   = count($_FILES['attachments']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                if (!empty($_FILES['attachments']['name'][$i])) {
                    $_FILES['attachments']['name']     = $files['attachments']['name'][$i];
                    $_FILES['attachments']['size']     = $files['attachments']['size'][$i];
                    $_FILES['attachments']['type']     = $files['attachments']['type'][$i];
                    $_FILES['attachments']['error']    = $files['attachments']['error'][$i];
                    $_FILES['attachments']['tmp_name'] = $files['attachments']['tmp_name'][$i];

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('attachments')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                    $attachments[] = ['file_name' => $this->upload->data('file_name'), 'orig_name' => $this->upload->data('orig_name')];
                }
            }
        }
        return  $attachments;
    }
}
