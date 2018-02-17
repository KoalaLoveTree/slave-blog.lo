<?php

namespace controllers\admin;


use repositories\RepositoryStorage;

class AdminPanelController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $commentRepository = RepositoryStorage::getCommentRepository();
        return $this->getView()->render('admin',[
            'comments' => $commentRepository->getCommentsForModeration(),
            ]);
    }

    public function deletePostAction()
    {

    }
}