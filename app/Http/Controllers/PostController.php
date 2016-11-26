<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function view() {
        return view('vuejs.index');
    }

    public function index() {
        $posts = Post::latest()->paginate(5);
        $response = [
            'pagination' => [
                'total'        => $posts->total(),
                'per_page'     => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'from'         => $posts->firstItem(),
                'to'           => $posts->lastItem()
            ],
            'data'       => $posts->items()
        ];

        return response()->json($response);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title'   => 'required',
            'summary' => 'required',
            'content' => 'required'
        ]);
        $create = Post::create($request->all());
        return response()->json($create);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'title'   => 'required',
            'summary' => 'required',
            'content' => 'required'
        ]);
        $update = Post::find($id)->update($request->all());
        return response()->json($update);
    }

    public function destroy($id) {
        Post::find($id)->delete();
        return response()->json([
            'error'       => false,
            'status_code' => 200
        ]);
    }
}
