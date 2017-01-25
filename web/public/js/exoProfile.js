/**
 * Created by sandman on 18/01/17.
 */

$(document).ready(function () {
    $(".askingTitle").click(function () {
        $('.askingHidden').css('display', 'block');
        $('.supplyHidden').css('display', 'none');
    });

    $(".supplyTitle").click(function () {
        $('.askingHidden').css('display', 'none');
        $('.supplyHidden').css('display', 'block');
    });

    $("#advertBlock").click(function () {
        $('.messagesAdminHidden').css('display', 'none');
        $('.userAdminHidden').css('display', 'none');
        $('.advertButtonHidden').css('display', 'block');

    });
    $("#userBlock").click(function () {
        $('.messagesAdminHidden').css('display', 'none');
        $('.advertButtonHidden').css('display', 'none');
        $('.userAdminHidden').css('display', 'block');
    });

    $("#messagesBlock").click(function () {
        $('.advertButtonHidden').css('display', 'none');
        $('.userAdminHidden').css('display', 'none');
        $('.messagesAdminHidden').css('display', 'block');
    });


    $(".validateAsking").click(function () {
        $.ajax({
            url: $('.validateAsking').data('path'),
            method: 'POST',
            success: function (data) {
                $('#' + $('.validateAsking').data('id')).addClass('isvalid');
                $('.validateAsking').remove();
            }
        });

    });

    $('.validateSupply').click(function () {
        $.ajax({
            url: $('.validateSupply').data('path'),
            method: 'POST',
            success: function (data) {
                $('#' + $('.validateSupply').data('id')).addClass('isvalid');
                $('.validateSupply').remove();
            }
        });
    });

});


