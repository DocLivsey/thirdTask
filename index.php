<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['user_name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}

if (empty($_POST['user_mail'])) {
    printf('Заполните почту.<br/>');
    $errors = TRUE;
}

if (empty($_POST['user_birth']) || !is_numeric($_POST['user_birth']) || !preg_match('/^\d+$/', $_POST['user_birth'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}

if(empty($_POST['user_bio'])) {
    print('Заполните биографию.<br/>');
    $errors = TRUE;
}
  
if(!isset($_POST['user_gender'])){
    print('Выберите пол.<br/>');
    $errors = TRUE;
}
  
if(!isset($_POST['superpowers'])){
    print('Выберите сверхспособности.<br/>');
    $errors = TRUE;
}
  
if(!isset($_POST['user_limb'])){
    print('Выберите количество конечностей.<br/>');
    $errors = TRUE;
}
  
if(!isset($_POST['accept_contract'])){
    print('Ознакомьтесь с контрактом.<br/>');
    $errors = TRUE;
}


// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u52839';
$pass = '1166154';
$db = new PDO('mysql:host=localhost;dbname=u52839', $user, $pass, [PDO::ATTR_PERSISTENT => true]);

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?");
  $stmt -> execute(['user_name']);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

try {
    $stmt = $db->prepare("INSERT INTO application (name, email, year, gender, limbs, biography) VALUES (:name, :email, :year, :gender, :limbs, :biography)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':limbs', $limbs);
    $stmt->bindParam(':biography', $biography);
  
    $name = $_POST['user_name'];
    $email = $_POST['user_mail'];
    $year = $_POST['user_birth'];
    $gender = $_POST['user_gender'][0];
    $limbs = $_POST['user_limb'][0];
    $biography = $_POST['user_bio'];
  
    $stmt->execute();
    $dbh = new PDO('mysql:host=localhost;dbname=u52839', $user, $pass);
    $last_id = $db->lastInsertId();
  
    $stmt = $db->prepare("INSERT INTO abilities (id, ability) VALUES (:id, :ability)");
    
    foreach($_POST['superpowers'] as $abil) {
      $stmt->bindParam(':id', $id);
      $stmt->bindParam(':ability', $ability);
      $id = $last_id;
      $ability = $abil;
      
      $stmt->execute();
    }
  
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');