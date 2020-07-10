<?php
    function connect_to_database(){
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $databasename = "base-site-rooting";

        try{
            $pdo=new PDO("mysql:host=$servername;dbname=$databasename",$username,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "<p>Vous êtes connecté</p>";
            return $pdo;
        }
        catch(PDOException $e) {
            echo "<p>Vous n'êtes pas connecté</p>".$e->getMessage();
        }
    }

    function login($pdo)
    {
        try{
            if(!empty($_POST['login']) && !empty($_POST['password'])){

                $login = $_POST['login'];
                $password = $_POST['password'];
                echo '1er if bon';

                $requete=$pdo->query("SELECT passwordd
                FROM `utilisateurs`
                WHERE login='$login'");
                $res=$requete->fetchAll();

                if($res) {
                    if($password == $res[0]['passwordd']){
                        echo "Connexion réussie: bon couple identifiant/mot de passe.";
                        $_SESSION['login'] = $login;
                        echo '<p> Login: ' .$_SESSION['login']. '</p>';
                        $sqlimage=$pdo->query("SELECT imgpath
                        FROM `utilisateurs`
                        WHERE login ='$login'");
                        $res=$sqlimage->fetchAll();
                        setcookie('imgpath',$res[0]['imgpath']);
                        echo $_COOKIE['imgpath'];
                        exit();
                    }
                    else{
                        echo "Mauvais couple identifiant/mot de passe.";
                    }
                }
                else{
                    echo "<a href='http://localhost:8888/ISCC-2020/ISCC-2020-J12/EX_01/mini-site-rooting.php?page=connexion'";
                }
            }
    
        }
        catch(PDOException $e) {
            echo "Login erreur" , $e->getMessage();
        }
    }

    function insertuser($pdo)
    {
        if($login['exist'] == '0'){
         $sql = "INSERT INTO utilisateurs(id,login,passwordd,imgpath)
        VALUES(' ', 'caroline','04022001','239780.jpg')";
        }
        else{
            $sql= "UPDATE utilisateurs
            SET passwordd='2021', imgpath='t02zf6xyg2q41.jpg'";
        }
    }
    $pdo = connect_to_database();
    login($pdo);
    insertuser($pdo);
?>
