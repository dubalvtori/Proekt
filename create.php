<?php
// Включване на конфигурационен файл (връзка с датабазата)
require_once "config.php";
 
// Дефиниране на променливи и инициализиране с празни стойности
$name = $age = $overall_grade = "";
$name_err = $age_err = $overall_grade_err = "";
 
// Обработка на данни от формуляра, когато формулярът е изпратен
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Потвърждаване на името
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Моля въведете име.";
    } else{
        $name = $input_name;
    }
    
    // Потвърждаване на възсрастта
    $input_age = trim($_POST["age"]);
    if(empty($input_age)){
        $age_err = "Моля въведете възраст.";     
    } else{
        $age = $input_age;
    }
    
    // Потвърждаване на заплатата
    $input_overall_grade = trim($_POST["overall_grade"]);
    if(empty($input_overall_grade)){
        $overall_grade_err = "Моля въведете оценка.";     
    }
    else{
        $overall_grade = $input_overall_grade;
    }
    
    // Проверка на грешките при въвеждане преди вмъкване в базата данни
    if(empty($name_err) && empty($age_err) && empty($overall_grade_err)){
        // Подготвяне на оператор за вмъкване
        $sql = "INSERT INTO student (name, age, overall_grade) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Свързване на променливи към подготвения оператор като параметри
            mysqli_stmt_bind_param($stmt, "sid", $param_name, $param_age, $param_overall_grade);
            
            // Задаване на параметри
            $param_name = $name;
            $param_age = $age;
            $param_overall_grade = $overall_grade;
            
            // Опит за изпълнение на подготвения оператор
            if(mysqli_stmt_execute($stmt)){
                // Записите са създадени успешно. Пренасочване към целевата страница
                header("location: dashboard.php");
                exit();
            } else{
                echo "Опа! Нещо се обърка. Моля опитайте по-късно.";
            }
        }
         
        // приключване на заявката
        mysqli_stmt_close($stmt);
    }
    
    // Затваряне на връзката
    mysqli_close($link);
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Създаване на нов ученик</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="stylecreates.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5"><strong>Създаване на нов ученик</strong></h2>
                    <p>Моля попълнете всички полета и натиснете бутона за потвърждение, за да запазите новият ученик в датабазата.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label><strong>Име</strong></label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="age"><strong>Възраст</strong></label>
                            <input type="text" id="age" name="age" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                            <span class="invalid-feedback"><?php echo $age_err;?></span>
                        </div>

                        <div class="form-group">
                            <label><strong>Оценка</strong></label>
                            <input type="text" name="overall_grade" class="form-control <?php echo (!empty($overall_grade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $overall_grade; ?>">
                            <span class="invalid-feedback"><?php echo $overall_grade_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-custom mb-2" value="Потвърдете">
                        <a href="dashboard.php" class="btn btn-outline-dark mb-2">Отказ</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
                           



                <!-- БИБЛИОТЕКА -->

<!-- trim() — Премахване на интервали (или други знаци) от началото и края на низ -->
<!-- empty() — Определяне дали дадена променлива е празна -->
<!-- filter_var() — Филтрира променлива с определен филтър -->
<!-- FILTER_VALIDATE_REGEXP проверява стойността спрямо Perl-съвместим регулярен израз -->
<!-- ctype_digit() — Проверка за числови знаци -->
<!-- mysqli_prepare() — Подготвя SQL израз за изпълнение -->
<!-- mysqli_stmt_bind_param() Използва се за обвързване на променливи към маркерите за параметри на подготвен израз -->
<!-- mysqli_stmt_execute() — Изпълнява подготвен израз -->
<!-- header() - Изпращане на необработена HTTP заявка -->
<!-- exit() — Извеждане на съобщение и прекратяване на текущия скрипт -->
<!-- mysqli_stmt_close() — Затваря подготвен израз -->
<!-- mysqli_close() — Затваря предварително отворена връзка с база данни -->
<!-- htmlspecialchars() — Преобразуване на специални знаци в HTML обекти -->