<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

class AccountsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index', 'view', 'add', 'edit', 'delete', 'token']);
    }
    public $paginate = [
        'page' => 1,
        'limit' => 100,
        'maxLimit' => 150,
/*        'fields' => [
            'id', 'name', 'description'
        ],
*/        'sortWhitelist' => [
            'id', 'name', 'description'
        ]
    ];
/*
    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        if ($action == 'index') {
            if ($user) {
                if ($user['role']['role'] == 'admin') {
                    return true;
                } else if ($user['role']['role'] == 'employe') {
                    return true;
                }
            }
        }
        return false;
    }
    public function initialize() {
        //parent::initialize();
        $this->Auth->allow(['add', 'token']);
    }

    public function add() {
        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => JWT::encode(
                            [
                        'sub' => $event->subject->entity->id,
                        'exp' => time() + 604800
                            ], Security::salt())
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }

    public function token() {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid information');
        }
        $this->set([
            'success' => true,
            'data' => [
                'token' => JWT::encode([
                    'sub' => $user['id'],
                    'exp' => time() + 604800
                        ], Security::salt())
            ],
            '_serialize' => ['success', 'data']
        ]);
    }*/
}
