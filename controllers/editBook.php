<?php

include "../config/dbconfig.php";

$id = $_POST['id'];
$get_book = "SELECT * FROM books WHERE id='$id'";
$get_book_query = mysqli_query($conn, $get_book) or die(mysqli_error($conn));
$output = array(
    "message" => "failed"
);
if ( mysqli_num_rows($get_book_query) > 0 )
{
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year_published = $_POST['year_published'];
    $category = $_POST['author'];

    $update_book = "UPDATE books
                    SET title = '$title', isbn = '$isbn', author = '$author', publisher='$publisher',
                        year_published = '$year_published', category = '$category'
                    WHERE id = '$id'";
    $udpate_book_query = mysqli_query($conn, $update_book) or die(mysqli_error($conn));
    $output = array(
        "message" => "success"
    );
}
echo json_encode($output);