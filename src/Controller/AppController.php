<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

//use Cake\Controller\Component\AuthComponent;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    use \Crud\Controller\ControllerTrait;
    /**
     * @var array
     */
    public $components = [
        'RequestHandler',
        'Crud.Crud' => [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]
    ];

    // In your AppController class for instance:

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent(
            'Auth', [
                'authorize' => 'Controller',
                'loginRedirect' => [
                    'controller' => 'schedules',
                    'action' => 'schedule-print'
                ],
                'logoutRedirect' => ['controller' => 'Users', 'action' => 'login']
            ]
        );

    }

    /**
     * @param $user
     */
    public function isAuthorized($user = null)
    {
        //$this->Auth->allow();
        return true;
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $loggedIn = $this->Auth->user();
        $personId = $this->Auth->user('person_id');

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        $table = TableRegistry::get('People');

        if ($personId > 0) {
            $userInfo = $table->find()
                ->where(
                    [
                        'id' => $personId
                    ]
                )
                ->first();
        }

        if (! isset($userInfo) || empty($userInfo)) {
            $userInfo = new \stdClass;
            $userInfo->full_name = $this->Auth->user('username');
        }

        $this->set('userInfo', $userInfo);

        $dbconfig = $table->getConnection()->config();
        unset($dbconfig['password']);

        $this->set(compact('dbconfig', 'loggedIn', 'userInfo'));
    }
}
