<?php
//  Очистка формы
if($_POST['name'] != "" || $_POST['date'] != "" || $_POST['value'] != ""){
    header("Location: index.php");
}

echo("
<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Добро пожаловать!</title>
</head>
<body>");
// База данных

// Подключение
$conn = new mysqli("localhost", "root", "", "test");

if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}



// // Добавление записи из формы
echo('<form action="" method="post">');
echo('<p>Имя: <input type="text" name="name" /></p>');
echo('<p>Дата: <input type="text" name="date" /></p>');
echo('<p>Значение: <input type="text" name="value" /></p>');

echo('<p><input type="submit" /></p>');
echo('</form>');

// Отправка данных в базу
$name = $_POST['name'];
$date = $_POST['date'];
$value = $_POST['value'];
if($name != "" || $date != "" || $value != "")
{
    $sql = "INSERT INTO 'test' ('Name', 'Date', 'Value') VALUES ('$name','$date',$value)";

    if($conn->query($sql)){
        echo "Данные успешно добавлены";
    } else{
        echo "Ошибка таблица: " . $conn->error;
    }
}
else{
    echo "Что-то пустое.";
}
// Получение данных из базы с удалением
$sql = "SELECT * FROM test";
if($result = mysqli_query($conn, $sql))
{
    echo "
        <table>
            <tr>
                <th>Имя</th>
                <th>Дата</th>
                <th>Значение</th>
            </th>
        </table>";
    foreach($result as $row){
        echo 
            "<tr>
                <td>" . $row["Name"] . "</td>
                <td>" . $row["Date"] . "</td>
                <td>" . $row["Value"] . "</td>
                <td>
                    <form action='delete.php' method='post'>
                        <input type='hidden' name='ID' value='" . $row["ID"] . "' />
                        <input type='submit' value='Удалить'>
                   </form>
                </td>
            </tr>";
    }
    echo "</table>";

mysqli_free_result($result);

}
else
{
    echo "Ошибка: " . mysqli_error($conn);
}

// Отключение
$conn->close();


echo("</body>
</html>");
?>



