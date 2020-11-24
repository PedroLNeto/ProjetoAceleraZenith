<?php 
//incluir a classe MPDF
include("mpdf60/mpdf.php");
//incluir a conexao
include("conect.php");

//configura a hora para São Paulo.
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/y');
$hora = date('H:i:s');
$conteudo = header('url=view.php');

$id = []; //recebe os IDs, em Chave-valor, é a Chave.
	$valor = []; //recebe os valores, em Chave-valor, é o Valor
	$x = 0;
	//conecta ao Banco de Dados
	$conect = new PDO("mysql: host=localhost;port=3306;dbname=TesteZenith","root","");
	$conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//Busca no BD os 30 últimos registros de uma tabela
	$sql = "SELECT * FROM Exemplo ORDER BY id  DESC LIMIT 30";
	$resultado = $conect->query($sql);
	while($linha = $resultado->fetch(PDO::FETCH_ASSOC))
	{
		$id[$x] = $linha["id"]; //alimenta a lista de chaves
		$valor[$x] = $linha["valor"]; //alimenta a lista de valores
		$x = $x + 1; //incrementa a posição da lista
	}
	$min = @min($valor); //obten o menor valor da coleção de dados
	$max = @max($valor); //obtem omaior valor da coleção de dados

ob_start();

//pegar o conteudo do buffer, inserir na variavel e limpar a memoria
$html = ob_get_clean();

//converter conteudo
$html = utf8_encode($html);

$html .= "
<html>

<style type='text/css'>
body {
	font-family: arial;
}
#col1 { 
  float:left; 
  width:40%; 
  color:#000000; 
  font-size:11pt; 
  font-family:arial; 
  text-align:justify; 
  margin-top:10px; 
  margin-right:10px; 
  margin-bottom:10px; 
  margin-left:10px; 
}
#col2 { 
  float:right; 
  width:40%; 
  color:#000000; 
  font-size:11pt; 
  font-family:arial; 
  text-align:justify; 
   margin-top:10px; 
   margin-right:10px; 
   margin-bottom:10px;
margin-left:10px;
}
</style>
	<body>
	<img src='logo.jpg' widht='45' height='45'><br>
		<br><b>Relatório:</b> documento baixado dia $data às $hora.<br>
		<b>Menor: </b>$min | <b>Maior: </b>$max
<br>
		<table border='1'>
		<tr>
			<th>Chave</th>
			<th>Valor</th>
		</tr>
		<tr>
			<td>$id[0]</td>
			<td>$valor[0]</td>
		</tr>
		<tr>
			<td>$id[1]</td>
			<td>$valor[1]</td>
		</tr>
		<tr>
			<td>$id[2]</td>
			<td>$valor[2]</td>
		</tr>
		<tr>
			<td>$id[3]</td>
			<td>$valor[3]</td>
		</tr>
		<tr>
			<td>$id[4]</td>
			<td>$valor[4]</td>
		</tr>
		<tr>
			<td>$id[5]</td>
			<td>$valor[5]</td>
		</tr>
		<tr>
			<td>$id[6]</td>
			<td>$valor[6]</td>
		</tr>
		<tr>
			<td>$id[7]</td>
			<td>$valor[7]</td>
		</tr>
		<tr>
			<td>$id[8]</td>
			<td>$valor[8]</td>
		</tr>
		<tr>
			<td>$id[10]</td>
			<td>$valor[10]</td>
		</tr>
		<tr>
			<td>$id[11]</td>
			<td>$valor[11]</td>
		</tr>
		<tr>
			<td>$id[12]</td>
			<td>$valor[12]</td>
		</tr>
		<tr>
			<td>$id[13]</td>
			<td>$valor[13]</td>
		</tr>
		<tr>
			<td>$id[14]</td>
			<td>$valor[14]</td>
		</tr>
		<tr>
			<td>$id[15]</td>
			<td>$valor[15]</td>
		</tr>
		<tr>
			<td>$id[16]</td>
			<td>$valor[16]</td>
		</tr>
		<tr>
			<td>$id[17]</td>
			<td>$valor[17]</td>
		</tr>
		<tr>
			<td>$id[18]</td>
			<td>$valor[18]</td>
		</tr>
		</table>

	</body>
</html>
";

//criar o objeto
$mpdf = new mPDF();

$mpdf->charset_in = 'UTF-8';

 $mpdf->WriteHTML($html);

$mpdf->Output('grafico.pdf','I');

exit();


?>