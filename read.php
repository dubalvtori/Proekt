<?php
// Проверка на съществуването на id параметър преди по-нататъчна обработка
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Включване на конфигурационен файл (връзка с датабазата)
    require_once "config.php";
    
    // Подготвяне на оператор за избор
    $sql = "SELECT * FROM student WHERE student_id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Свързване на променливи към подготвения оператор като параметри
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Задаване на параметри
        $param_id = trim($_GET["id"]);
        
        // Опит за изпълнение на подготвения оператор
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Извличане на реда с резултати като асоциативен масив. От набора от резултати
                съдържа само един ред, не е необходимо да използваме цикъл while */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Извличане на индивидуална стойност на полето
                $name = $row["name"];
                $age = $row["age"];
                $overall_grade = $row["overall_grade"];
            } else{
                // URL адресът не съдържа валиден id параметър. Пренасочване към страницата за грешка
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Опа! Нещо се обърка. Моля опитайте по-късно.";
        }
    }
     
    // приключване на заявката
    mysqli_stmt_close($stmt);
    
    // Затваряне на връзката
    mysqli_close($link);
} else{
    // URL адресът не съдържа id параметър. Пренасочване към страницата за грешка
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Преглед на ученик</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="styleread.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-5 mb-3">Преглед на ученик: <b><?php echo $row["name"]; ?></b></h1>
                    <div class="info-container">
                        <label><strong>Име</strong></label>
                        <p><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="info-container">
                        <label><strong>Възраст</strong></label>
                        <p><?php echo $row["age"]; ?></p>
                    </div>
                    <div class="info-container">
                        <label><strong>Оценка</strong></label>
                        <p><?php echo $row["overall_grade"]; ?></p>
                    </div>
                    <p><a href="dashboard.php" class="btn btn-custom mt-3">Назад</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

                <!-- БИБЛИОТЕКА -->

<!-- isset() — Определя дали дадена променлива е декларирана и е различна от нула -->
<!-- empty() — Определяне дали дадена променлива е празна -->
<!-- trim() — Премахване на интервали (или други знаци) от началото и края на низ -->
<!-- mysqli_prepare() — Подготвя SQL израз за изпълнение -->
<!-- mysqli_stmt_bind_param() Използва се за обвързване на променливи към маркерите за параметри на подготвен израз -->
<!-- mysqli_stmt_execute() — Изпълнява подготвен израз -->
<!-- mysqli_stmt_get_result() — Получава набор от резултати от подготвен израз като mysqli_result обект -->
<!-- mysqli_result() - Представлява набора от резултати, получен от заявка към базата данни -->
<!-- mysqli_num_rows() — Получава броя на редовете в резултатния набор -->
<!-- mysqli_fetch_array() — Извличане на ред от резултатен набор като асоциативен, числов масив -->
<!-- header() - Изпращане на необработена HTTP заявка -->
<!-- exit() — Извеждане на съобщение и прекратяване на текущия скрипт -->
<!-- mysqli_stmt_close() — Затваря подготвен израз -->
<!-- mysqli_close() — Затваря предварително отворена връзка с база данни -->