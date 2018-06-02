<?php
namespace app\rbac;
use yii\rbac\Rule;
use Yii;
class IsAuthorRule extends Rule
{
    public $name = 'isAuthorRule';
    public function execute($user, $item, $params)
    {
        if (!isset($params['article'])) {
            return false;
        }
        return ($params['article']->author_id == $user);
    }
}