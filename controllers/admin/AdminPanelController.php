<?php

namespace controllers\admin;


use core\FileNotFoundException;
use core\PermissionDeniedException;
use repositories\CommentRepositoryInterface;
use repositories\RepositoryStorage;
use response\ResponseInterface;
use response\SuccessResponse;

class AdminPanelController extends AdminController
{
    /**
     * AdminPanelController constructor.
     * @throws PermissionDeniedException
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    public function indexAction(): ResponseInterface
    {
        $commentRepository = $this->createCommentRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('admin', [
            'comments' => $commentRepository->getCommentsForModeration(),
        ]));
        return $response;
    }

    /**
     * @return CommentRepositoryInterface
     */
    protected function createCommentRepository(): CommentRepositoryInterface
    {
        return RepositoryStorage::getCommentRepository();
    }
}
