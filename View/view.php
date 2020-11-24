<?php
date_default_timezone_set('America/Sao_Paulo'); //Busca a hora de São Paulo
	$id = []; //recebe os IDs, em Chave-valor, é a Chave.
	$valor = []; //recebe os valores, em Chave-valor, é o Valor
	$x = 0;
	$user = $_GET["r"];
	$password = $_GET["p"];
	$database = $_GET["db"];
	$table = $_GET["t"];
	//conecta ao Banco de Dados
	$conect = new PDO("mysql: host=localhost;port=3306;dbname=$database","$user","$password");
	$conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//Busca no BD os 30 últimos registros de uma tabela
	$sql = "SELECT * FROM $table ORDER BY id  DESC LIMIT 30";
	$resultado = $conect->query($sql);
	//echo "Linhas: ".$resultado;
	while($linha = $resultado->fetch(PDO::FETCH_ASSOC))
	{
		$id[$x] = $linha["id"]; //alimenta a lista de chaves
		$valor[$x] = $linha["valor"]; //alimenta a lista de valores
		$x = $x + 1; //incrementa a posição da lista
	}
	$id_join = join("|",$id); //cria uma string única com os dados da chave separado por pipe |
	$val_join = join("|",$valor); //cria uma string única com os dados do valor separadoporpipe |
	$min = @min($valor); //obten o menor valor da coleção de dados
	$max = @max($valor); //obtem omaior valor da coleção de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
     <title>ZENITH | View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/css.css">
    <script src="package/dist/Chart.min.js"></script> <!--Chama o arquivo de apoio à geração de gráfico-->
    <script src="cronometro.js"></script> <!--Chama o arquivo que faz o cronometro de atualização-->
  </head>

  <body id="fundo">
    <div class="card" id="telaGrafico">
 <!--<img src="..." class="card-img-top" alt="...">-->
        <div class="card-body" id="grafico">
        	<p>
        		<?php
        		echo "
        		<a href='gerarpdf.php'>
        			<button class='button' align='left'><b>Relatório</b></button>
        		</a>
        		&nbsp;|&nbsp;
        		<b>Entrou: </b>$valor[0]
        		<b> | Maior: </b>$max
        		<b> | Menor: </b>$min
        		<b> | Atualizado há: </b>
        		";
        		?>
        		<span id="hora">00h</span><span id="minuto">00m</span><span id="segundo">00segundos</span><br>
        	</p>
            <canvas id="myChart" width="1200" height="300">
			<script>
				var id = "<?php echo $id_join; ?>"; //Passa a string de chaves para a variavel
				var id_labels = id.split("|"); //split a cada pipe | gerando uma nova lista com as chaves
				var valor = "<?php echo $val_join; ?>"; //Passa a string de valores para a variavel
				var val_labels = valor.split("|"); //split a cada pipe | gerando uma nova lista com os valores
				var menor = "<?php echo $min; ?>"; //recebe o valor minimo da coleção
				var maior = "<?php echo $max; ?>"; //recebe o valor maximo da coleção

				var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: [//chaves
						id_labels[0], id_labels[1], id_labels[2], id_labels[3], id_labels[4],
						id_labels[5], id_labels[6], id_labels[7], id_labels[8], id_labels[9],
						id_labels[10], id_labels[11], id_labels[12], id_labels[13],
						id_labels[14], id_labels[15], id_labels[16], id_labels[17],
						id_labels[18], id_labels[19], id_labels[20], id_labels[21],
						id_labels[22], id_labels[23], id_labels[24], id_labels[25],
						id_labels[26], id_labels[27], id_labels[28], id_labels[29]],
						datasets: [{
							label: 'ZENITH ',
							data: [//valores
							val_labels[0], val_labels[1], val_labels[2], val_labels[3], val_labels[4],
							val_labels[5], val_labels[6], val_labels[7], val_labels[8], val_labels[9],
							val_labels[10], val_labels[11], val_labels[12], val_labels[13], val_labels[14],
							val_labels[15], val_labels[16], val_labels[17], val_labels[18], val_labels[19],
							val_labels[20], val_labels[21], val_labels[22], val_labels[23], val_labels[24],
							val_labels[25], val_labels[26], val_labels[27], val_labels[28], val_labels[29]
							],
							backgroundColor: [
								'rgba(54, 162, 235, 0.1)'
							],
							borderColor: [
								'rgba(54, 162, 235, 3)'
							],
							borderWidth: 3
						}]
					},
                    options: {
                        animation: false
                    }
				});
			</script>
	</canvas>
</div>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>

<?php
//atualiza a página a cada 100 segundos
@header("Refresh: 4; url = view.php");
?>