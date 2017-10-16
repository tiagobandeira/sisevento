<meta charset="utf-8">
<form method="post" action="gerarpdf.php">
   <label for="nome">Nome:</label><br>
   <input type="text" id="nome" name="nome"><br>
   <label for="horas">Horas:</label><br>
   <input type="text" id="horas" name="horas"><br>
   <label for="data">Data por extenso:</label><br>
   <input type="text" id="data" name="data"><br>
   <textarea id="texto" name="texto" cols="100" rows="10"></textarea>
   <br>
   <input type="submit" value="Gerar PDF"><br>
</form>

<?php

echo @date('d');
