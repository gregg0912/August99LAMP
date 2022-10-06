<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />

    	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
        <script src="js/index.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <title>AUGUST99 - LAMP</title>
    </head>
    <body>
        <div class="container">
            <div id="liveAlertPlaceholder"></div>

            <div class="add-button-div row align-items-center">
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBookModal">
                        Add
                    </button>
                </div>
            </div>
            <div class="row align-items-center">
                <table id="books">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">TITLE</th>
                            <th class="text-center" scope="col">ISBN</th>
                            <th class="text-center" scope="col">AUTHOR</th>
                            <th class="text-center" scope="col">PUBLISHER</th>
                            <th class="text-center" scope="col">YEAR PUBLISHED</th>
                            <th class="text-center" scope="col">CATEGORY</th>
                            <th class="text-center" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Book Modal -->
        <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addBookModalLabel">Add Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="title" id="title" placeholder="John Doe's Book">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="isbn" id="isbn" placeholder="978-1-56619-909-4">
                            <label for="isbn">ISBN</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="author" id="author" placeholder="John Doe">
                            <label for="author">Author</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="John Doe's Publisher">
                            <label for="publisher">Publisher</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="year_published" placeholder="1999">
                            <label for="year_published">Year Published</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="category" id="category" placeholder="Horror">
                            <label for="category">Category</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addBook">Add Book</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteBookModalLabel">Delete Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2>Are you sure you want to delete <span id="delete-book-title"></span>?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteBook">Delete Book</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Edit Book Modal -->
        <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editBookModalLabel">Edit Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="title" id="title" placeholder="John Doe's Book">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="isbn" id="isbn" placeholder="978-1-56619-909-4">
                            <label for="isbn">ISBN</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="author" id="author" placeholder="John Doe">
                            <label for="author">Author</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="John Doe's Publisher">
                            <label for="publisher">Publisher</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="year_published" placeholder="1999">
                            <label for="year_published">Year Published</label>
                        </div>
                        <div class="col-sm-12 form-floating mb-3">
                            <input type="text" class="form-control" name="category" id="category" placeholder="Horror">
                            <label for="category">Category</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editBook">Update Book</button>
                </div>
                </div>
            </div>
        </div>

    </body>
</html>