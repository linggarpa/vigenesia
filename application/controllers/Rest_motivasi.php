<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Rest_motivasi extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }


    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $api = $this->db->get('motivasi')->result();
        } else {
            $this->db->where('id', $id);
            $api = $this->db->get('motivasi')->result();
        }
        $this->response($api, 200);
    }



    function index_post()
    {
        $data = array(
            'id'           => $this->post('id'),
            'isi_motivasi'          => $this->post('isi_motivasi'),
            'iduser'    => $this->post('iduser'),
            'tanggal_input'    => $this->post('tanggal_input'),
            'tanggal_update'    => $this->post('tanggal_update'),
        );
        $insert = $this->db->insert('motivasi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }



    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'id'           => $this->post('id'),
            'isi_motivasi'          => $this->post('isi_motivasi'),
            'iduser'    => $this->post('iduser'),
            'tanggal_input'    => $this->post('tanggal_input'),
            'tanggal_update'    => $this->post('tanggal_update'),
        );
        $this->db->where('id', $id);
        $update = $this->db->update('motivasi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('motivasi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
