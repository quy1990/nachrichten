<?php

namespace Modules\Comment\Http\Controllers;

use Modules\Comment\Entities\Comment;
use Modules\User\Http\Controllers\Controller;

class LatestCommentsController extends Controller
{
    public function __invoke(): array
    {
        $comments = Comment::paginate(5);
        $notifications = [];
        foreach ($comments as $comment) {
            $notifications[] = $this->generateNotification($comment);
        }
        return $notifications;
    }

    private function generateNotification(Comment $comment): array
    {
        return [
            "icon"    => "bx bx-error",
            "content" => $comment->body
        ];
    }
}
