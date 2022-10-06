<?php

include "../config/dbconfig.php";

$get_all_books = "SELECT * FROM books";
$get_all_books_query = mysqli_query($conn, $get_all_books) or die(mysqli_error($conn));

$books = [];
while( $book = mysqli_fetch_assoc($get_all_books_query) )
{
    $books[] = array(
        "id" => $book['id'],
        "title" => $book['title'],
        "isbn" => $book['isbn'],
        "author" => $book['author'],
        "publisher" => $book['publisher'],
        "year_published" => $book['year_published'],
        "category" => $book['category']
    );
}

echo json_encode(array("books" => $books));