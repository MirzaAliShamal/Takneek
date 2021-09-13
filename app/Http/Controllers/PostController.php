<?php

namespace App\Http\Controllers;

use App\Models\PostPollOption;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function list(Request $req)
    {
        if ($req->ajax()) {
            $page = 1;
            $per_page = 10;

            // Define the default order
            $order_field = 'id';
            $order_sort = 'desc';

            // Get the request parameters
            $params = $req->all();
            $query = Post::with('post_category', 'user', 'post_images', 'post_tags', 'post_poll_options');

            // Set the current page
            if(isset($params['pagination']['page'])) {
                $page = $params['pagination']['page'];
            }

            // Set the number of items
            if(isset($params['pagination']['perpage'])) {
                $per_page = $params['pagination']['perpage'];
            }

            // Set the search filter
            if(isset($params['query']['generalSearch'])) {
                $query->where('name', 'LIKE', "%" . $params['query']['generalSearch'] . "%")
                ->orWhere('file', 'LIKE', "%" . $params['query']['generalSearch'] . "%");
            }

            // Get how many items there should be
            $total = $query->limit($per_page)->count();

            // Get the items defined by the parameters
            $results = $query->skip(($page - 1) * $per_page)->take($per_page)->orderBy($order_field, $order_sort)->get();

            $data = [
                'meta' => [
                    "page" => $page,
                    "pages" => ceil($total / $per_page),
                    "perpage" => $per_page,
                    "total" => $total,
                    "sort" => $order_sort,
                    "field" => $order_field
                ],

                'data' => $results
            ];
            return response()->json($data, 200);
        } else {
            return view('back.post.list', get_defined_vars());
        }

    }

    public function add(Request $req)
    {
        $categories = PostCategory::orderBy('name', 'ASC')->get();
        $users = User::where('id', '!=', auth()->user()->id)->orderBy('name', 'ASC')->get();

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.post.add', get_defined_vars())->render(),
        ]);
    }

    public function edit($id = null)
    {
        $categories = PostCategory::orderBy('name', 'ASC')->get();
        $users = User::where('id', '!=', auth()->user()->id)->orderBy('name', 'ASC')->get();

        $post = Post::with('post_category', 'user', 'post_images', 'post_tags', 'post_poll_options')->find($id);

        return response()->json([
            'statusCode' => 200,
            'html' => view('back.post.edit', get_defined_vars())->render(),
        ]);
    }

    public function save(Request $req, $id = null)
    {
        if (is_null($id)) {
            $post = new Post();
        } else {
            $post = Post::find($id);
        }
        $post->uuid = postUUID();
        $post->post_type = $req->post_type;
        $post->title = $req->title;
        $post->content = $req->content;
        $post->post_category_id = $req->post_category_id;
        $post->user_id = $req->user_id;
        if ($req->post_type == "poll") {
            $post->poll_type = $req->poll_type;
            $post->poll_question = $req->poll_question;
            $post->poll_option_count = $req->poll_option_count;
        }
        if ($req->post_type == "job") {
            $post->job_type = $req->job_type;
            $post->job_salary = $req->job_salary;
            $post->job_requirements = $req->job_requirements;
            $post->job_technologies = $req->job_technologies;
        }
        $post->save();

        if ($post) {
            if (isset($req->images)) {
                $post->post_images()->delete();
                for ($i=0; $i < count($req->images) ; $i++) {
                    $post_image = new PostImage();
                    $post_image->post_id = $post->id;
                    $post_image->path = uploadFile($req->images[$i],'posts');
                    $post_image->save();
                }
            }

            if (isset($req->tags)) {
                $post->post_tags()->delete();
                for ($i=0; $i < count($req->tags) ; $i++) {
                    $post_tag = new PostTag();
                    $post_tag->post_id = $post->id;
                    $post_tag->name = $req->tags[$i];
                    $post_tag->save();
                }
            }

            if ($req->post_type == "poll") {
                if (isset($req->poll_options)) {
                    $post->post_poll_options()->delete();
                    for ($i=0; $i < count($req->poll_options) ; $i++) {
                        $post_poll_option = new PostPollOption();
                        $post_poll_option->post_id = $post->id;
                        $post_poll_option->title = $req->poll_options[$i];
                        $post_poll_option->save();
                    }
                }
            }
        }

        return redirect()->back();
    }

    public function delete($id = null)
    {
        return redirect()->back();
    }
}
