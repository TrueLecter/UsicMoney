<!DOCTYPE html >
<html>

<head>
    <title>UsicMoney</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="https://usic.at/favicon.ico">
    <script src="js/_customUtils.js"></script>
</head>

<body>
    <div style="padding-right: 5px; padding-left:5px;">
        <!-- navbar -->
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-5">
                    <span class="sr-only">UsicMoney</span>
                </button>
                <a class="navbar-brand" href="#">UsicMoney</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-5">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">&#1042;&#1085;&#1077;&#1089;&#1077;&#1085;&#1085;&#1103; &#1082;&#1086;&#1096;&#1090;&#1110;&#1074;</a>
                    </li>
                    <li><a href="incasation.php">&#1030;&#1085;&#1082;&#1072;&#1089;&#1072;&#1094;&#1110;&#1103;</a>
                    </li>
                    <li><a href="selection.php" class="dropdown-toggle" data-toggle="dropdown">&#1050;&#1072;&#1089;&#1080;<b class="caret"></b></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

        </nav>

        <div style="display: block; padding:0.75%;"></div>
        <center>
            <?php
if (isset($HTTP_GET_VARS[success])) {
  if ($HTTP_GET_VARS[success] == "true") {
    echo "<h3 style='color: green;'>Запит виконано успішно!";
  } else {
    echo "<h3 style='color: red;'>Помилка під час виконання запиту!";
  }
} else {
  echo "<h3>Додати запис";
} ?></h3>
            <div style="display: block; padding:1.5%;"></div>
            <form name="addForm" action="add.php" method="post">
                <table>
                    <tr>
                        <td>
                            <div class="cell">ПІБ</div>
                        </td>
                        <td>
                            <div class="cell">Кошти (X.YY)</div>
                        </td>
                        <td>
                            <div class="cell">Тип каси</div>
                        </td>
                        <td>
                            <div class="cell">Примітка</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="valueCell">
                            <div class="form-group">
                                <input type="text" name="nameF" class="form-control" placeholder="ПІБ" required>
                            </div>
                        </td>
                        <td class="valueCell">
                            <div class="form-group">
                                <input type="text" name="moneyF" class="form-control" placeholder="Гроші" required pattern="(-)?\d+([\.,]\d{0,2})?">
                            </div>
                        </td>
                        <td>
                            <select data-toggle="select" class="form-control select select-primary mrs mbm" name="typeF" style="margin-bottom: 20px;">
                                <option value="cass" selected>Принтер</option>
                                <option value="tea">Чайок</option>
                            </select>
                        </td>
                        <td class="valueCell">
                            <div class="form-group">
                                <input type="text" name="commentF" class="form-control" placeholder="Комментар">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <center>
                                <input type="submit" value="Надіслати" class="btn btn-info">
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </center>
        <script src="js/jquery.min.js"></script>
        <script src="js/flat-ui.min.js"></script>
        <script src="js/application.js"></script>
    </div>
</body>

</html>
