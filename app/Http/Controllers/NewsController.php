<?php

namespace App\Http\Controllers;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @return array
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $sort = $request->query('sort');
        $page = $request->query('page');
        $per_page = $request->query('per_page')??5;
        $news = News::all();
        if (!empty($filter)) {
            if(!empty($filter['title'])) {
                $title = str_replace('"','',$filter['title']);
                $news = $news->filter(
                    function($item) use ($title) {
                        return stripos($item->title,$title) !== false;
                    }
                );
            }
            if(!empty($filter['content'])) {
                $content = str_replace('"','',$filter['content']);
                $news = $news->filter(
                    function($item) use ($content) {
                        return stripos($item->content,$content) !== false;
                    }
                );
            }
            if(isset($filter['is_published'])) {
                $is_published = str_replace('"','',$filter['is_published']);
                $news = $news->filter(
                    function($item) use ($is_published) {
                        return $item->is_published == $is_published;
                    }
                );
            }

        }
        if (!empty($sort)) {
            $key = $sort['key'];
            $order = $sort['order']??"asc";
            $descending = (strtolower($order) == "desc")??false;
            $news = $news->sortBy($key,SORT_NATURAL,$descending);
        }
        if (!empty($page)) {
            $news = $news->forPage($page,$per_page);
        }
        return array_reverse($news->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $news = new News([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'is_published' => $request->input('is_published')
        ]);
        $news->save();

        return response()->json('Product created!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $news = News::find($id);
        return response()->json($news);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $news = News::find($id);
        $news->update($request->all());

        return response()->json('News updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return response()->json('News deleted!');
    }
}
