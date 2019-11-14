<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * Description of SchedulesController
 *
 * @author jmcd
 */
class PartsController extends AppController
{

    public function initialize(){
        parent::initialize();
       // $this->Auth->allow(['getParts']);
    }
    public $paginate = [
        'page' => 1,
        'limit' => 20,
        'maxLimit' => 100,

    ];

    public function getParts() {
        $parts = $this->Parts->find('all', [
            'conditions' => [
                'active' => true
            ],
            'order' => [
                'sort_order + 0',
            ]
        ]
        );

        $this->set(compact('parts'));
        $this->set('_serialize', ['parts']);
    }
}
