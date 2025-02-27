<?php
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="styledashb.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>
</head>
<body>
    <div class="user-session">
                <div class="user-session-inner">
                    <p><h1><strong>Здравей, <?php echo $_SESSION['username']; ?>!</strong></h1></p>
                    <p><h3><strong>Вие се намирате във вашият контролен панел.</strong></h3></p>
                    <p><a href="logout.php" class="btn-exit"><strong>Изход</strong></a></p>
                </div>
            </div>
    <div class="wrapper">
        <div class="inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="text-center">
                        <div class="my-5 clearfix">
                            <h1><strong>Подробности за учениците<strong></h1>
                            <a href="create.php" class="btn btn-custom mt-3"><i class="fas fa-plus"></i><strong> Добави нов ученик</strong></a>
                        </div>

                    <?php
                    // Включване на конфигурационен файл (връзка с датабазата)
                    require_once "config.php";
                    
                    // Опит за изпълнение на заявка за избор на служители
                    $sql = "SELECT * FROM student";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Име</th>";
                                        echo "<th>Възраст</th>";
                                        echo "<th>Крайна Оценка</th>";
                                        echo "<th>Действие</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['student_id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['age'] . "</td>";
                                        echo "<td>" . $row['overall_grade'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="read.php?id='. $row['student_id'] .'" class="mx-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Преглед"><span class="fas fa-eye"></span></a>';
                                        echo '<a href="update.php?id='. $row['student_id'] .'" class="mx-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Редактиране"><span class="fas fa-pencil-alt"></span></a>';
                                        echo '<a href="delete.php?id='. $row['student_id'] .'" class="mx-2 px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Изтриване"><span class="fas fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Краен резултат от резултати
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Няма намерени служители.</em></div>';
                        }
                    } else{
                        echo "Опа! Нещо се обърка. Моля опитайте по-късно.";
                    }
 
                    // Затваряне на връзката
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


                <!-- БИБЛИОТЕКА -->

<!-- mysqli_query() — Извършва заявка в базата данни -->
<!-- mysqli_num_rows() — Получава броя на редовете в резултатния набор -->
<!-- mysqli_fetch_array() — Извличане на ред от резултатен набор като асоциативен, числов масив -->
<!-- mysqli_free_result() — Освобождава паметта, свързана с резултат -->
<!-- mysqli_close() — Затваря предварително отворена връзка с база данни -->

