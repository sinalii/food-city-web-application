<?php

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=3306;dbname=food_city",
        "root",
        "Nelu123#"
    );

    echo "MySQL Connected Successfully";

} catch (PDOException $e) {
    echo $e->getMessage();
}
