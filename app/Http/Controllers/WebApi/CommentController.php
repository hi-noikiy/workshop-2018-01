<?php

namespace App\Http\Controllers\WebApi;

use App\Comment;
use App\CommentMessageControl;
use App\CommentPopularity;
use App\Http\Requests\AddComment;
use App\Http\ReturnHelper;
use App\Post;
use App\PostPopularity;
use App\Transformers\CommentTransformer;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function Sodium\crypto_box_publickey_from_secretkey;

class CommentController extends Controller
{
    public function addToPost(AddComment $request ,$id)
    {
        $post = Post::find($id);
        if(null === $post){
            return ReturnHelper::returnWithStatus('未找到指定文章',2003);
        }

        $user_id = session('user')->id;

        $comment = new Comment();
        $comment->post_id = $id;
        $comment->user_id = $user_id;
        $comment->parent_id = 0;
        $comment->level = 1;
        $comment->body = $request->input('body');

        $post_popularity = $post->getPopularity();
        $post_popularity->comment_count = $post_popularity->commen_count + 1;

        $comment_message = new CommentMessageControl();
        $comment_message->user_id = $post->user_id;

        $comment_popularity = new CommentPopularity();
        try{
            $comment->save();

            $post_popularity->save();

            $comment_popularity->comment_id = $comment->id;
            $comment_popularity->save();

            $comment_message->comment_id = $comment->id;
            $comment_message->save();

        }catch (\Exception $e){
            return ReturnHelper::returnWithStatus('评论失败',3001);
        }

        return ReturnHelper::returnWithStatus(Fractal::item($comment,new CommentTransformer()));
    }

    public function addToComment(AddComment $request, $id)
    {
        $parent_comment = Comment::find($id);
        if(null === $parent_comment){
            return ReturnHelper::returnWithStatus('未找到指定评论',3002);
        }

        $user_id = session('user')->id;

        $post_popularity = $parent_comment->getPost()->getPopularity();
        $post_popularity->comment_count = $post_popularity->comment_count + 1;

        $parent_comment_popularity = $parent_comment->getFirstLevelParent()->getPopularity();
        $parent_comment_popularity->comment_count = $parent_comment_popularity->comment_count + 1;

        $comment = new Comment();
        $comment->post_id = $parent_comment->post_id;
        $comment->user_id = $user_id;
        $comment->parent_id = ($parent_comment->level === 3 ) ? $parent_comment->parent_id : $id;
        $comment->level = ($parent_comment->level == 1 )? 2 : 3;
        $comment->body = $request->input('body');

        $comment_message = new CommentMessageControl();
        $comment_message->user_id = $parent_comment->user_id;

        try{
            $comment->save();
            $post_popularity->save();

            $parent_comment_popularity->save();

            $comment_message->comment_id = $comment->id;
            $comment_message->save();
        }catch (\Exception $e){
            return ReturnHelper::returnWithStatus('评论失败',3001);
        }

        return ReturnHelper::returnWithStatus(Fractal::item($comment,new CommentTransformer()));
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(null === $comment){
            return ReturnHelper::returnWithStatus('未找到指定评论',3002);
        }
        if(session('user')->id !== $comment->user_id){
            return ReturnHelper::returnWithStatus('您没有权限删除该评论',3003);
        }

        if($comment->level === 1){
            $comment_popularity = $comment->getPopularity();
        }

        $post_popularity = $comment->getPost()->getPopularity();

        $comment_message = CommentMessageControl::findByCommentId($id);

        try{
            $cnt = $comment->deleteSelfAndChildren();

            $post_popularity->comment_count = $post_popularity->comment_count - $cnt;
            $post_popularity->save();

            isset($comment_popularity)? $comment_popularity->delete():false;
            $comment_message->delete();

        }catch (\Exception $e){
            return ReturnHelper::returnWithStatus('删除评论失败',3001);
        }

        return ReturnHelper::returnWithStatus('删除评论成功');
    }

    public function getPostComments(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        if($post === null ){
            return ReturnHelper::returnWithStatus('未找到指定文章',2003);
        }

        $cnt = $request->input('cnt',15);

        $paginator = $post->comments()->orderBy('id', 'desc')->simplePaginate($cnt);
        $comments = $paginator->getCollection();

        return ReturnHelper::returnWithStatus(
            Fractal::collection($comments, new CommentTransformer()),
            200,
            $paginator
        );
    }

}
