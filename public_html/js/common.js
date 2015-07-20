/**
 * Created by slashman on 19.06.15.
 */

$(document).on('click', 'a.delete-submit', function(e){
    e.preventDefault();
    e.stopPropagation();
    e.noBubble = true;
    var a = $(this);
    swal({
        title: "Удалить?",
        //text: "Your will not be able to recover this imaginary file!",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Да",
        closeOnConfirm: false
    },
    function(){
        window.location.href = $(a).attr('href');
    });
});

$(document).on('keyup', '#new-name', function(e){
    var name = $(this).val();

    if(name)
        $('#new-name-title').text(name);
    else
        $('#new-name-title').text('Новый сайт');
});