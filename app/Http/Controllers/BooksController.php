<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book;

class BooksController extends Controller
{
    public function index() {
        // 入力された検索ワードをurlエンコード
        $items   = array();
        $keyword = request()->keyword;
        $keyword = urlencode($keyword);

        // 検索ワードがあれば、検索処理を開始
        if ($keyword) {
            $data = "https://www.googleapis.com/books/v1/volumes?q=intitle:${keyword}&maxResults=2&country=JP&orderBy=newest";
            $json         = file_get_contents($data);
            $json_decode  = json_decode($json,true);
            $json_decode  = $json_decode['items'];

            foreach ($json_decode as $item) {
                $title     = '';
                $imageUrl  = '';
                $url       = '';
                $publisher = '';
                $authors   = '';
                $author    = '';

                $title     = $item['volumeInfo']['title'];
                $imageUrl  = $item['volumeInfo']['imageLinks']['thumbnail'];
                $url       = $item['volumeInfo']['infoLink'];

                // 必須ではない項目は、存在する場合のみ取得
                if (isset($item['volumeInfo']['publisher'])) {
                    $publisher = $item['volumeInfo']['publisher'];
                }
                if (isset($item['volumeInfo']['authors'])) {
                    $authors   = $item['volumeInfo']['authors'];
                    $author    = implode(',', $authors);
                }

                // 扱いやすいように分解して渡す
                $items[]   =  array('title'     => $title,
                                    'imageUrl'  => $imageUrl,
                                    'url'       => $url,
                                    'publisher' => $publisher,
                                    'author'    => $author);
            }
        }
        return view('books.index',compact('items'));
    }
}
