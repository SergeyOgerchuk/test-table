<?php

include_once 'model/User.php';

echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Title</title>
    <link rel=\"stylesheet\" href=\"view/css/style.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.3.1/css/all.css\"
          integrity=\"sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU\" crossorigin=\"anonymous\">
</head>
<body>
<div class = 'head'>
<div class = 'search'>
    <form method=\"post\" action='search.php'>
      <input type=\"text\" name=\"search\" placeholder='Введите id пользователя' required/>
      <input type=\"submit\" value=\"Поиск\"/>
    </form>
    </div>
        <div class=\"add-box\">
            <button id=\"add_button\" class=\"add-btn\">
                <i class=\"fas fa-plus\"></i>
            </button>
        </div>
           </div>
        <div class = 'main'>";

echo "<table class=\"table\" id =\"Mytable\" >
            <tr>
                <td class=\"table_head head_cell_0\">id</td>
                <td class=\"table_head head_cell_1\">Имя</td>
                <td class=\"table_head head_cell_2\">Фамилия</td>
                <td class=\"table_head head_cell_3\">Возраст</td>
                <td class=\"table_head head_cell_4\">Телефон</td>
                <td class=\"table_head head_cell_5\">email</td>
                ";

$rows = User::showAllUsers();
echo "<form method='POST' id = 'deleteForm' onsubmit= 'deleteUser(); return false;'>";
foreach ($rows as $row) {
    echo "<tbody>";
    echo "<tr id = ${row[0]}>";
    echo "<td class=\"td-info\" cellnum=\"0\">${row[0]}</td>";
    echo "<td class=\"td-info\" cellnum=\"1\">${row[1]}</td>";
    echo "<td class=\"td-info\" cellnum=\"2\">${row[2]}</td>";
    echo "<td class=\"td-info\" cellnum=\"3\">${row[3]}</td>";
    echo "<td class=\"td-info\" cellnum=\"4\">${row[4]}</td>";
    echo "<td class=\"td-info\" cellnum=\"5\">${row[5]}</td>";
    echo "<td class=\"td_checkbox\"><label class=\"container\">";
    echo "<input type='checkbox'  class = checkbox name='delete_row[]' value=${row[0]}'>";
    echo "<span class=\"checkmark\"></span>";
    echo "</tr>";
}
echo "</tbody></table></div></div></div><div class = 'submit'><input type='submit' value='Удалить выделенные записи'></form></div>";
echo "<div id=\"addModal\" class=\"modal\">
    <div class=\"modal-content\">
        <span class=\"close\">&times;</span>
        <form method='POST' action=\"create.php\">
            <div class=\"create_container\">
                <h1>Создание нового пользователя</h1>
                <p>Пожалуйста введите данные, чтобы создать запись</p>
                <hr>
                <label for=\"name\"><b>Имя</b></label>
                <label>
                    <input class = \"create_input\" placeholder=\"Имя пользователя\" name=\"name\" required>
                </label>
                <label for=\"surname\"><b>Фамилия</b></label>
                <label>
                    <input class = \"create_input\" placeholder=\"Фамилия пользователя\" name=\"surname\" required>
                </label>
                <label for=\"age\"><b>Возраст</b></label>
                <label>
                    <input class = \"create_input\" placeholder=\"Возраст пользователя\" name=\"age\" required>
                </label>
                <label for=\"phone\"><b>Номер телефона</b></label>
                <label>
                    <input class = \"create_input\" placeholder=\"Номер телефона\" name=\"phone_number\" required>
                </label>
                <label for=\"email\"><b>Email</b></label>
                <label>
                    <input class = \"create_input\" placeholder=\"Email\" name=\"email\" required>
                </label>
                <hr>
                <button type=\"submit\" class=\"registerbtn\">Создать запись</button>
            </div>
        </form>
    </div>
</div>";
echo "<script>
    var modal = document.getElementById(\"addModal\");
    var btn = document.getElementById(\"add_button\");
    var span = document.getElementsByClassName(\"close\")[0];
    btn.onclick = function () {
        modal.style.display = \"block\";
    };
    span.onclick = function () {
        modal.style.display = \"none\";
    };
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = \"none\";
        }
    }
</script>";
echo "<script src=\"view/js/jquery.js\"></script>
<script src=\"view/js/main.js\"></script></body></html>";

if (isset($_POST["delete_row"])) {
    $delete_row = $_POST["delete_row"];

    foreach ($delete_row as $row) {
        User::deleteUser($row);
    };
}
