<?php

include "../config/dbconfig.php";

$id = $_POST['id'];
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

$delete_book = "DELETE FROM books WHERE id='$id'";
$delete_book_query = mysqli_query($conn, $delete_book) or die(mysqli_error($conn));

echo json_encode(array("book" => $output));