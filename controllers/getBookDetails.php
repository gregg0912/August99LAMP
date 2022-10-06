<?php

include "../config/dbconfig.php";

$id = $_GET['id'];
$get_book = "SELECT * FROM books WHERE id='$id'";
$get_book_query = mysqli_query($conn, $get_book) or die(mysqli_error($conn));

$output = [];
while( $book = mysqli_fetch_assoc($get_book_query) )
{
    $output = array(
        "id" => $book['id'],
        "title" => $book['title'],
        "isbn" => $book['isbn'],
        "author" => $book['author'],
        "publisher" => $book['publisher'],
        "year_published" => $book['year_published'],
        "category" => $book['category']
    );
}

echo json_encode(array("book" => $output));