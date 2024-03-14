<? php
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //----- DATABASE CONNECTION -----//

    $database = new mysqli('localhost', 'root', 'test');
    if ($database -> connect_error) {
        echo "$database -> connect_error";
        die ("Connection Failed : ". $database -> connect_error);

    } else {
        $sync = $database -> prepare("insert into registration(name, username, email, password) values(?, ?, ?, ?)");
        $sync -> bind_param("ssssi", $name, $username, $email, $password);
        $execute = $sync->execute();
        echo $execute;
        echo "Login successfully...";
        $sync->close();
        $database->close();
    }
>