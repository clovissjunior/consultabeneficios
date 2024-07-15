<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['matricula'];
    $filename = 'dados.csv';  // Nome do arquivo CSV

    if (($handle = fopen($filename, "r")) !== FALSE) {
        $found = false;
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if ($data[1] == $matricula) {  // Verifica a segunda coluna (índice 1)
                $found = true;
                $descricao = $data[0];
                $nome = $data[2];
                $observacao = $data[3];
                break;
            }
        }
        fclose($handle);

        if ($found) {
            echo "<h2>Resultado da Consulta:</h2>";
            echo "<p><strong>Benefício:</strong> $descricao</p>";
            echo "<p><strong>Matricula:</strong> $matricula</p>";
            echo "<p><strong>Nome:</strong> $nome</p>";
            echo "<p><strong>Observação:</strong> $observacao</p>";
        } else {
            echo "<p>Nenhum resultado encontrado para a matrícula $matricula.</p>";
        }
    } else {
        echo "<p>Não foi possível abrir o arquivo de dados.</p>";
    }
    echo '<button onclick="window.location.href=\'index.html\'">Voltar à Página Inicial</button>';
} else {
    echo "<p>Método de requisição inválido.</p>";
    echo '<button onclick="window.location.href=\'index.html\'">Voltar à Página Inicial</button>';
}
?>
