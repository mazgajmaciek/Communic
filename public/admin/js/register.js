$('body').on('submit', '#modalRegister', function (element) {

    element.preventDefault();

    alert('asdkadhgsk');
    // var id = $(this).find('#id').val();
    //
    // console.log(id);
    //
    // var bookTitle = $bookEditForm.find('#title').val();
    // var bookDesc = $bookEditForm.find('#description').val();
    // var bookAuthorEditId = $authorIdEdit.val();
    //
    //
    //
    // var editedBook = {
    //     title: bookTitle,
    //     description: bookDesc,
    //     author_id: bookAuthorEditId
    // };
    //
    // console.log('Ajax');
    // //ajax query - edits book title and/or description in db
    // $.ajax({
    //     url: '../rest/rest.php/book/' + id,
    //     type: 'PATCH',
    //     data: editedBook
    // })
    //     .done(function (response) {
    //         console.log('done, book id: ' + id + " edited in db");
    //         $bookEditForm.slideUp();
    //
    //         //here should edit the relevant id in books list
    //         console.log(id);
    //         //updates relevant existing book list title
    //         var $bookListTitle = $('[class="bookTitle"][data-id=' + id + ']');
    //         $bookListTitle.text(response.success[0].title);
    //
    //
    //     })
    //     .fail(function (error) {
    //         console.log('Fail');
    //         console.log('Edit book error', error);
    //         console.log(JSON.stringify(error));
    //     });

})