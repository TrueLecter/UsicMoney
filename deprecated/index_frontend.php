<!DOCTYPE html>
<html>

<head>
    <title>UsicMoney</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/the-tooltip.css" rel="stylesheet" />
    <link href="css/loader.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="https://usic.at/favicon.ico">
    <script src="js/_customUtils.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script src="js/application.js"></script>
    <script src="js/the-tooltip.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        sendRequest();
        $("#selection").hide();
        $("#incasation").hide();
        $("#menusNSum").hide();  
    });
    </script>
</head>

<body>
    <div style="padding-right: 5px; padding-left:5px;">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-5">
                    <span class="sr-only">UsicMoney</span>
                </button>
                <a class="navbar-brand" href="#">UsicMoney</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-5">
                <ul class="nav navbar-nav">
                    <li id="aLink" class="active"><a href="#" onclick="changePage0();">&#1042;&#1085;&#1077;&#1089;&#1077;&#1085;&#1085;&#1103; &#1082;&#1086;&#1096;&#1090;&#1110;&#1074;</a>
                    </li>
                    <li id="bLink"><a href="#" onclick='changePage1();'>&#1030;&#1085;&#1082;&#1072;&#1089;&#1072;&#1094;&#1110;&#1103;</a>
                    </li>
                    <li id="cLink"><a href="#" onclick='changePage2();'>&#1050;&#1072;&#1089;&#1080;</a>
                    </li>
                </ul>
                <ul id="menusNSum" class="nav navbar-nav navbar-right">
                    <li class="dropdown" id="rangeMenu">
                    </li>
                    <li class="dropdown" id="typeMenu">
                    </li>
                    <li>
                        <a href="#" id="totalValue"></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="adding">
            <div style="display: block; padding:0.75%;"></div>
            <center>
                <h3 id="result">Додати запис</h3>
                <div style="display: block; padding:1.5%;"></div>
                <form id="form" name="addForm" onsubmit="sendMoney();" action="javascript:void(0);">
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
                                    <input type="text" id="nameF" name="nameF" class="form-control" placeholder="ПІБ" required>
                                </div>
                            </td>
                            <td class="valueCell">
                                <div class="form-group">
                                    <input type="text" id="moneyF" name="moneyF" class="form-control" placeholder="Гроші" required pattern="(-)?\d+([\.,]\d{0,2})?">
                                </div>
                            </td>
                            <td>
                                <select id="typeF" data-toggle="select" class="form-control select select-primary mrs mbm" name="typeF" style="margin-bottom: 20px;">
                                    <option value="cass" selected>Принтер</option>
                                    <option value="tea">Чайок</option>
                                </select>
                            </td>
                            <td class="valueCell">
                                <div class="form-group">
                                    <input type="text" id="commentF" name="commentF" class="form-control" placeholder="Комментар">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <center>
                                    <input type="submit" value="Надіслати" id="submitB" class="btn btn-info">
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
        <div id="selection">
            <center>
                <div id="tableV">
                </div>
            </center>
        </div>
        <div id="incasation">
            <div style="display: block; padding:0.75%;"></div>
            <center>
                <h3 id="mamka">Зняти гроші</h3>
                <div style="display: block; padding:1.5%;"></div>
                <form name="addForm" onsubmit="getMoney();" action="javascript:void(0);" id="formG">
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
                        </tr>
                        <tr>
                            <td class="valueCell">
                                <div class="form-group">
                                    <input type="text" name="nameF" class="form-control" placeholder="ПІБ" required>
                                </div>
                            </td>
                            <td class="valueCell">
                                <div class="form-group">
                                    <input type="text" name="moneyF" class="form-control" placeholder="Гроші" required pattern="\d+([\.,]\d{0,2})?">
                                </div>
                            </td>
                            <td>
                                <select data-toggle="select" class="form-control select select-primary mrs mbm" name="typeF" style="margin-bottom: 20px;">
                                    <option value="cass" selected>Принтер</option>
                                    <option value="tea">Чайок</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <center>
                                    <input id="submitB1" type="submit" value="Забрати" class="btn btn-info">
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
    </div>
</body>

</html>
