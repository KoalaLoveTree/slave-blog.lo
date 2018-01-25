<?php

namespace controllers;

use models\index\IndexModel;

class IndexController extends Controller
{

    public function indexAction()
    {
        $model = new IndexModel();
        $data = $model->getPostsForHome();
        return $this->getView()->render('index', [
            'first' => $data[0]['title'],
            'second' => $data[1]['title'],
            'third' => $data[2]['title'],
            'firstLink' => $data[0]['id'],
            'secondLink' => $data[1]['id'],
            'thirdLink' => $data[2]['id'],
        ]);
    }

}