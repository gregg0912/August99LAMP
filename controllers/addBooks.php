<?php

include "../config/dbconfig.php";

$title = $_POST['title'];
$isbn = $_POST['isbn'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$year_published = $_POST['year_published'];
$category = $_POST['category'];
$insert_book = "INSERT INTO books(title, isbn, author, publisher, year_published, category)
                VALUES('$title', '$isbn', '$author', '$publisher', '$year_published', '$category')";
$insert_book_sql = mysqli_query($conn, $insert_book) or die(mysqli_error($conn));

$output = array(
    "message" => "success"
);

echo json_encode($output);