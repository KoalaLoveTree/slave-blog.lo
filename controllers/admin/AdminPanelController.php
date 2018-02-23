<?php

namespace controllers\admin;


use repositories\RepositoryStorage;
use response\SuccessResponse;

class AdminPanelController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $commentRepository = RepositoryStorage::getCommentRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('admin', [
            'comments' => $commentRepository->getCommentsForModeration(),
        ]));
        return $response;
    }
}