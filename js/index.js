$(document).ready(function()
{
    let base_url = window.location.origin;

    loadBooks();
    function loadBooks()
    {
        $.ajax({
            type: "GET",
            url: base_url+"/August99LAMP/controllers/getBooks.php",
            success: function(data){
                let decoded_data = JSON.parse(data);
                let books = decoded_data.books;
                if ( books.length == 0 )
                {
                    let rows = "<tr><td colspan='7'>No books found in database.</td></tr>";
                    $("#books tbody").empty();
                    $("#books tbody").html(rows);
                }
                else
                {
                    let rows = "";
                    $(books).each(function(){
                        let book = $(this)[0];
                        let edit_button = "<button type='button' class='btn btn-secondary edit-book' data-id='"+ book.id +"'>Edit</button>";
                        let delete_button = "<button type='button' class='btn btn-secondary delete-book' data-id='"+ book.id +"'>Delete</button>";
                        rows += "<tr>"+
                                "<td>"+ book.title +"</td>"+
                                "<td>"+ book.isbn +"</td>"+
                                "<td>"+ book.author +"</td>"+
                                "<td>"+ book.publisher +"</td>"+
                                "<td>"+ book.year_published +"</td>"+
                                "<td>"+ book.category +"</td>"+
                                "<td>"+
                                    edit_button+
                                    delete_button+
                                "</td>"+
                            +"</tr>";
                    });
                    $("#books tbody").empty();
                    $("#books tbody").html(rows);
                }
            }
        })
    }

    $("[name='year_published']").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    }).on('hide', function(e) {
        e.stopPropagation();
    });

    // Add Books
    $("#addBook").on("click", function(){
        let title = $("#addBookModal [name='title']").val();
        let isbn = $("#addBookModal [name='isbn']").val();
        let author = $("#addBookModal [name='author']").val();
        let publisher = $("#addBookModal [name='publisher']").val();
        let year_published = $("#addBookModal [name='year_published']").val();
        let category = $("#addBookModal [name='category']").val();

        let parent = $(this).closest(".modal");
        $.ajax({
            type: "POST",
            url: base_url+"/August99LAMP/controllers/addBooks.php",
            data: {
                title: title,
                isbn: isbn,
                author: author,
                publisher: publisher,
                year_published: year_published,
                category: category,
            },
            success: function(data){
                let decoded_data = JSON.parse(data);
                let message = decoded_data.message;
                if ( message == 'success' )
                {
                    alert("You have successfully added "+ title +" to the database.", "success");
                    parent.modal("hide");
                    loadBooks();
                }
            }
        });
    });

    $(document).on('hide.bs.modal', "#addBookModal", function(){
        $("#addBookModal [name='title']").val('');
        $("#addBookModal [name='isbn']").val('');
        $("#addBookModal [name='author']").val('');
        $("#addBookModal [name='publisher']").val('');
        $("#addBookModal [name='year_published']").val('');
        $("#addBookModal [name='category']").val('');
    });

    // Delete Book
    $(document).on("click", ".delete-book", function(e)
    {
        let book_id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: base_url+"/August99LAMP/controllers/getBookDetails.php",
            data: {id: book_id},
            success: function(data)
            {
                let decoded_data = JSON.parse(data);
                let book = decoded_data.book;
                let title = book.title;
                $("#delete-book-title").html(title);
            }
        });
        $("#deleteBook").attr("data-id", book_id);
        $("#deleteBookModal").modal("show");
    });

    $("#deleteBookModal").on('hide.bs.modal', function(){
        $("#deleteBook").attr("data-id", "");
    });

    $(document).on("click", "#deleteBook", function()
    {
        let book_id = $(this).attr("data-id");
        let parent = $(this).closest(".modal");

        $.ajax({
            type: "POST",
            url: base_url+"/August99LAMP/controllers/deleteBook.php",
            data: {id: book_id},
            success: function(data)
            {
                let decoded_data = JSON.parse(data);
                let book = decoded_data.book;
                let title = book.title;
                alert("Successfully deleted "+title+" from database", "success");
                parent.modal("hide");
                loadBooks();
            }
        });
    });

    // Edit Book
    $(document).on("click", ".edit-book", function()
    {
        let book_id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: base_url+"/August99LAMP/controllers/getBookDetails.php",
            data: {id: book_id},
            success: function(data)
            {
                let decoded_data = JSON.parse(data);
                let book = decoded_data.book;
                $("#editBookModal [name='title']").val(book.title);
                $("#editBookModal [name='isbn']").val(book.isbn);
                $("#editBookModal [name='author']").val(book.author);
                $("#editBookModal [name='publisher']").val(book.publisher);
                $("#editBookModal [name='year_published']").val(book.year_published);
                $("#editBookModal [name='category']").val(book.category);
            }
        });
        $("#editBook").attr("data-id", book_id);
        $("#editBookModal").modal("show");
    });

    $(document).on('hide.bs.modal', "#editBookModal", function(){
        $("#editBookModal [name='title']").val('');
        $("#editBookModal [name='isbn']").val('');
        $("#editBookModal [name='author']").val('');
        $("#editBookModal [name='publisher']").val('');
        $("#editBookModal [name='year_published']").val('');
        $("#editBookModal [name='category']").val('');
        $("#editBook").attr("data-id", "");
    });

    $(document).on("click", "#editBook", function(){
        let book_id = $(this).attr("data-id");
        let parent = $(this).closest(".modal");
        let title = $("#editBookModal [name='title']").val();
        let isbn = $("#editBookModal [name='isbn']").val();
        let author = $("#editBookModal [name='author']").val();
        let publisher = $("#editBookModal [name='publisher']").val();
        let year_published = $("#editBookModal [name='year_published']").val();
        let category = $("#editBookModal [name='category']").val();

        let data = {
            id: book_id,
            title: title,
            isbn: isbn,
            author: author,
            publisher: publisher,
            year_published: year_published,
            category: category
        }
        $.ajax({
            type: "POST",
            url: base_url+"/August99LAMP/controllers/editBook.php",
            data: data,
            success: function(data)
            {
                alert("Successfully updated "+title, "success");
                loadBooks();
                parent.modal("hide");
            }
        })
    });

    const alertPlaceholder = $("#liveAlertPlaceholder");

    function alert(message, type)
    {
        const wrapper = "<div>"+
        '<div class="alert alert-'+type+' alert-dismissible" role="alert">'+
            '<div>'+ message +'</div>'+
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>'+
        "</div>";

        alertPlaceholder.append(wrapper)
    }
});