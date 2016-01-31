<?php
App::uses('AclComponent', 'Controller/Component');
App::uses('AuthComponent', 'Controller/Component');
App::uses('HtmlHelper', 'View/Helper');
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
     * Инициализация HTML-хелпера
     * @var
     */
    public $Html;

    /**
     * AclHelper constructor
     */
    public function __construct() {
        $collection = new ComponentCollection();
        $this->Acl = new AclComponent($collection);
        $this->Auth = new AuthComponent($collection);
        $this->Html = new HtmlHelper(new View());
    }

    /**
     * Проверка доступности путей или массива путей для пользователя
     * @param $url
     * @return bool
     */
    public function check($url) {
        $groupId = $this->Auth->user('group_id');
        $access = true;
        if(is_array($url)) {
            foreach ($url as $item) {
                $item = $this->_getAcoPath($item);
                $access &= $this->Acl->check(
                    array(
                        'model' => 'Group',
                        'foreign_key' => $groupId
                    ), $item
                );
            }
        } elseif(is_string($url)) {
            $url = $this->_getAcoPath($url);
            $access = $this->Acl->check(
                array(
                    'model' => 'Group',
                    'foreign_key' => $groupId
                ), $url
            );
        }
        return $access;
    }

    /**
     * Проверка доступности хотя бы одного пути в массиве путей (для вывода пункта родительского меню)
     * @param $urls
     * @return bool
     */
    public function checkList($urls) {
        $access = false;
        foreach ($urls as $url) {
            if($access = $this->check($url)) {
                break;
            }
        }
        return $access;
    }

    /**
     * @param $title
     * @param $url
     * @param array $options
     * @param array $confirm
     * @return bool|string
     */
    public function link($title, $url, $options = array(), $confirm = array()) {
        return $this->check($url) ? $this->Html->link($title, $url, $options, $confirm) : false;
    }

    /**
     * @param $url
     * @return string
     */
    protected function _getAcoPath($url) {
        $route = Router::parse($url);
        $url = 'controllers/'.ucfirst($route['controller']).'/'.$route['action'];
        return $url;
    }
}