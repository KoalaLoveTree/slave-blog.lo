<?php
/**
 * Created by PhpStorm.
 * User: AgyKoala
 * Date: 21.01.2018
 * Time: 9:43
 */

namespace controllers;


class IndexController extends Controller
{

    public function indexAction()
    {
        return $this->getView()->render('index', [
            'hello' => 'Welcome to slave blog!',
        ]);
    }

}