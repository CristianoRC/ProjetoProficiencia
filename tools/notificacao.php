<?php

function printarAlerta($texto, $cor)
{
    echo "<div class=\"alert alert-$cor alert-dismissible fade show\" role=\"alert\">
        $texto
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
    </button>
</div>";
}
