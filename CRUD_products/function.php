<?php 

//Подключаемся к базе данных
function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'admin';
    $DATABASE_PASS = 'Admin_Password123321';
    $DATABASE_NAME = 'portendb';
    try{
        
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    }catch (PDOException $exception)
    {
        exit('Failed to connect to database');
    }
}

//Шаблон верхнего колонтикула
function template_header($title, $user)
{
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>$title</title>
            <link href="style.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        </head>
        <body>
        <nav class="navtop">
            <div>
                <h1>Website Title</h1>
                <a href="read.php"><i class="fas fa-address-book"></i>Home</a>
                <a href="#"><i class="fas fa-address-book"></i>$user</a>
            </div>
        </nav>
    EOT;
}



//Шаблон нижнего колонтикула
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}

?>