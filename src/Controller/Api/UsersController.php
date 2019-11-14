<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Api;

//use Cake\Network\Exception\UnauthorizedException;
use App\Controller\Api\AppController;
use App\Exception\TgnUnauthorizedException;
use Cake\Event\Event;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Description of SchedulesController
 *
 * @author jmcd
 */
class UsersController extends AppController
{
    public $paginate = [
        'page' => 1,
        'limit' => 5,
        'maxLimit' => 15,
        'sortWhitelist' => [
            'id', 'name',
        ],
    ];

    /**
     * initialize()
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add', 'token']);
    }

    /**
     * add()
     */
    public function add()
    {
        $this->Crud->on('afterSave', function (Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => JWT::encode(
                        [
                            'sub' => $event->subject->entity->id,
                            'exp' => time() + 604800,

                        ],
                        Security::salt()
                    ),
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });

        return $this->Crud->execute();
    }

    /**
     * security token JWT
     */
    public function token()
    {
        $user = $this->Auth->identify();
        if (!$user) {
            //UnauthorizedException::responseHeader('Access-Control-Allow-Origin', "*");

            // extended to send access control allow origin header
            throw new TgnUnauthorizedException('Invalid username or password. You drongo!');
        }

        $this->set([
            'success' => true,
            'data' => [
                'token' => JWT::encode([
                    'sub' => $user['id'],
                    'exp' => time() + 604800,
                    'user' => $user['username'],
                ], Security::salt()),
            ],
            '_serialize' => ['success', 'data'],
        ]);
    }
}
