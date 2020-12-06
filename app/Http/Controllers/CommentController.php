<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentNotification;
use Pusher\Pusher;

class CommentController extends Controller
{
    protected function addComment(Request $request) {
        if (!Auth::user()) {
            return response()->json([
                'status' => 401,
                'message' => trans('view.comments.need_login')
            ]);
        }

        $product_id = $request->product_id;
        $content = $request->content;

        $data = ['content' => $content, 'member_id' => Auth::id(), 'product_id' => $product_id];
        $result = Comment::create($data);

        $comment = Comment::findOrFail($result->id)->load('member');

        if ($result) {
            $this->sendNotificationToAdmin($product_id);
            $this->realtimeNotification();

            return response()->json([
                'status' => 200,
                'message' => trans('view.comments.comment_success'),
                'view' => view('components.comment', compact('comment'))->render()
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => trans('view.comments.comment_failed')
            ]);
        }
    }

    protected function deleteComment(Comment $comment) {
        $this->authorize('delete', $comment);

        $result = $comment->delete();

        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => trans('view.comments.delete_comment_success')
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => trans('view.comments.delete_comment_failed')
            ]);
        }
    }

    public function sendNotificationToAdmin($product_id)
    {
        $member = User::where('email', config('settings.mail_admin'))->firstOrFail();

        $data = [
            'member_id' => Auth::id(),
            'product_id' => $product_id
        ];

        Notification::send($member, new CommentNotification($data));
    }

    public function realtimeNotification()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
          );
          $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
          );
        
        $data['message'] = 'hello world';
        $pusher->trigger('notification-channel', 'notification-event', $data);
    }
}
