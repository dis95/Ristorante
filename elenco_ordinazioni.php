<html>
<?php
	require_once 'Classes\Connection.php';
    require_once 'Operazioni\Operazioni.php';
?>
    <head>
        <title>Elenco ordinazioni</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
        <link rel="stylesheet" href="Css/bgrTheme.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
    </head>
	<body>
	<div data-role="header" data-position="fixed" data-theme="c">
	        <a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Indietro</a>
                <div align="center"><h2>Ordinazioni</h2></div>
    </div>
    <ul data-role="listview" data-theme="c" >
      <?php
	  foreach(Operazioni::getIdTavoloOrdinazioni() as $el){
		echo ("<li><a href=\"ordinazione.php?idTavolo=".$el['idTavolo']."\" data-ajax=\"false\">Tavolo ".$el['idTavolo']."</a></li>");
	  }
	  ?>
    </ul>
	
	</body>
	</html>