<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class LatestCommentsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

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
