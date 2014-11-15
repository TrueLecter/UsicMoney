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
    <script src="js/_customUtils_ajax_iJson.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script src="js/application.js"></script>
    <script src="js/the-tooltip.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    			$("#loader").hide();
    			sendRequest();
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
                <a class="navbar-brand" href="index.php">UsicMoney</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-5">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">&#1042;&#1085;&#1077;&#1089;&#1077;&#1085;&#1085;&#1103; &#1082;&#1086;&#1096;&#1090;&#1110;&#1074;</a>
                    </li>
                    <li><a href="incasation.php">&#1030;&#1085;&#1082;&#1072;&#1089;&#1072;&#1094;&#1110;&#1103;</a>
                    </li>
                    <li class="active"><a href="#">&#1050;&#1072;&#1089;&#1080;</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
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
        <center>
            <div id="tableV">
            </div>
        </center>
        </br>
       <div id="loader"><!--<center>
                    <div id="circularG">
                        <div id="circularG_1" class="circularG">
                        </div>
                        <div id="circularG_2" class="circularG">
                        </div>
                        <div id="circularG_3" class="circularG">
                        </div>
                        <div id="circularG_4" class="circularG">
                        </div>
                        <div id="circularG_5" class="circularG">
                        </div>
                        <div id="circularG_6" class="circularG">
                        </div>
                        <div id="circularG_7" class="circularG">
                        </div>
                        <div id="circularG_8" class="circularG">
                        </div>
                    </div></center>-->
                </div>

</body>

</html>
