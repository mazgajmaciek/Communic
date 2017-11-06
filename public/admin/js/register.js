$(function () {
    $('body').on('submit', '#modalRegister', function (element) {
        element.preventDefault();


        var $username = $('#modalRegister').find('#username').val();
        alert($username);

    });
});