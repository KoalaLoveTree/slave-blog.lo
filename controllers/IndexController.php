<?php

namespace controllers;

use models\index\IndexModel;

class IndexController extends Controller
{

    public function indexAction()
    {
        $model = new IndexModel();
        $data = $model->getPosts();
        return $this->getView()->render('index', [
            'first' => $data[0]->getTitle(),
            'second' => $data[1]->getTitle(),
            'third' => $data[2]->getTitle(),
            'firstLink' => $data[0]->getId(),
            'secondLink' => $data[1]->getId(),
            'thirdLink' => $data[2]->getId(),
        ]);
    }
}