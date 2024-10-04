<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>pr2</title>
</head>
<body>
    <?php
    if (isset($_POST['reg'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user = ['name' => "$name", 'email' => "$email", 'phone' => "$phone"];
        $errors = validateForm($user);
    }
    ?>
    <form class="form-block" method="post" enctype="multipart/form-data" name="reg">
        <h1>зарегистрироваться</h1>
        <div class="input-label">
            <label for="name">имя*</label>
            <input type="text" name="name" placeholder="Имя" value="<?php if (isset($_POST['reg'])) echo $name ?>">
        </div>
        <div class="input-label">
            <label for="email">email*</label>
            <input type="text" name="email" placeholder="Почта" value="<?php if (isset($_POST['reg'])) echo $email ?>">
        </div>
        <div class="input-label">
            <label for="phone">телефон*</label>
            <input type="text" name="phone" placeholder="Телефон" value="<?php if (isset($_POST['reg'])) echo $phone ?>">
        </div>
        <input class="input-btn" type="submit" value="зарегистрироваться" name="reg">
        <p>
            <?php
            if (isset($_POST['reg'])) {
                if (empty($errors)) {
                    echo "<p class=no-error>форма успешно валидирована!</p>";
                } else {
                    foreach ($errors as $error) {
                        echo '<p class="errors">' . $error .'</p>';
                    }
                }
            }
            ?>
        </p>
    </form>
    <?php
    function validateForm($user)
    {
        $errors = [];
        if (empty($user['name'])) {
            $errors[] = "поле 'Имя' не должно быть пустым.";
        } elseif (strlen($user['name']) < 3 || strlen($user['name']) > 50) {
            $errors[] = "длина поля 'имя' должна быть от 3 до 50 символов.";
        }
        if (empty($user['email'])) {
            $errors[] = "поле 'Email' не должно быть пустым.";
        } elseif (strlen($user['email']) > 255) {
            $errors[] = "длина поля 'Email' не должна превышать 255 символов.";
        } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Неверный формат email.";
        }
        if (empty($user['phone'])) {
            $errors[] = "поле 'Номер телефона' не должно быть пустым.";
        } elseif (strlen($user['phone']) != 11) {
            $errors[] = "номер телефона должен содержать 11 символов.";
        }
        return $errors;
    }
    ?>
</body>
</html>