<?php
App::uses('AclComponent', 'Controller/Component');
App::uses('AuthComponent', 'Controller/Component');
App::uses('AppHelper', 'View/Helper');

class AclHelper extends AppHelper {

    /**
     * Инициализация Acl-компонента в хелпере
     * @var
     */
    public $Acl;

    /**
     * Инициализация Auth-компонента в хелпере
     * @var
     */
    public $Auth;

    /**
     * AclHelper constructor
     */
    public function __construct() {
        $collection = new ComponentCollection();
        $this->Acl = new AclComponent($collection);
        $this->Auth = new AuthComponent($collection);
    }

    /**
     * Проверка доступности ссылки
     * @param $url
     * @return bool
     */
    public function check($url) {
        $groupId = $this->Auth->user('group_id');
        $access = true;
        if(is_array($url)) {
            foreach ($url as $item) {
                $access &= $this->Acl->check(
                    array(
                        'model' => 'Group',
                        'foreign_key' => $groupId
                    ), $item
                );
            }
        } elseif(is_string($url)) {
            $access = $this->Acl->check(
                array(
                    'model' => 'Group',
                    'foreign_key' => $groupId
                ), $url
            );
        }
        return $access;
    }
}