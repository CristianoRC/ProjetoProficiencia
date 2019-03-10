<?php
function printarTabela($headers, $conteudo)
{
    $topo = "<table class=\"table\">
    <thead>
      <tr>";
    $cabecalho = "";
    foreach ($headers as $key => $value) {
        $cabecalho .= "<th scope=\"col\">$value</th>";
    }
    $fimTopo = "</tr>
    </thead>";
    $inicioCorpo = "<tbody>";

    $corpo = "";
    if ($conteudo != null) {
        foreach ($conteudo as $value) {
            $corpo .= "<tr>";
            foreach ($value as $informacoes) {
                $corpo .= "<td>$informacoes</td>";
            }
            $corpo .= "<tr>";
        }
    }

    $fimCorpo = "</tbody>";
    $fimTabela = "</table>";
    echo ("
      $topo
      $cabecalho
      $fimTopo
      $inicioCorpo
      $corpo
      $fimCorpo
      $fimTabela
    ");
}
