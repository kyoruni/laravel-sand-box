<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book;

class BooksController extends Controller
{
    public function index() {
        $keyword = urlencode("どうぶつの森");
        $data = "https://www.googleapis.com/books/v1/volumes?q=intitle:${keyword}&maxResults=2&country=JP&orderBy=newest";
        $json         = file_get_contents($data);
        $json_decode  = json_decode($json,true);

        $items = array();
        $json_decode = $json_decode['items'];
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

            if (isset($item['volumeInfo']['publisher'])) {
                $publisher = $item['volumeInfo']['publisher'];
            }

            if (isset($item['volumeInfo']['authors'])) {
                $authors   = $item['volumeInfo']['authors'];
                $author    = implode(',', $authors);
            }

            $items[]   =  array('title'     => $title,
                                'imageUrl'  => $imageUrl,
                                'url'       => $url,
                                'publisher' => $publisher,
                                'author'    => $author);
        }
        dump("items");
        dump($items);
        return view('books.index',compact('items'));
    }
}
