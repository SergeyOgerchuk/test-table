$(document).ready(function () {
    var table = $('.table'),
        cell = $('.td-info');

    function mouseMove() {
        $(cell).mouseover(function () {
            var cellNum = $(this).attr('cellnum'),
                parent = $(this).parents("tr:first");
            $('.td-info' + '.cell_' + cellNum).each(function () {
                $(this).addClass('hover-td-other');
            });
            parent.find('td').addClass('hover-td-other');
            parent.find('.table_head').addClass('table_head-hover');
            $(this).removeClass('hover-td-other').addClass('hover-td');
            table.find('.head_cell_' + cellNum).addClass('table_head-hover');
        });
        $(cell).mouseout(function () {
            $(this).removeClass('hover-td');
            var cellNum = $(this).attr('cellnum'),
                parent = $(this).parents("tr:first");
            $('.td-info' + '.cell_' + cellNum).each(function () {
                $(this).removeClass('hover-td-other');
            });
            parent.find('td').removeClass('hover-td-other');
            parent.find('.table_head').removeClass('table_head-hover');
            table.find('.head_cell_' + cellNum).removeClass('table_head-hover');
        })
    }

    mouseMove();

});

// функция удаления пользователя
function deleteUser() {

    var id = [];

    $(':checkbox:checked').each(function (i) {
        id[i] = $(this).val();
    });

    if (id.length === 0) {
        alert("Выберите хотя бы одну строку для удаления");
    } else {
        $.ajax({
            url: 'index.php',
            method: 'POST',
            data: {delete_row: id},
            success: function () {
                $('table tr').has('input:checked').remove();
            }
        })
    }
}
