<form method="POST">
    
    <h3><?= ($numero_domanda) ?>) <?= ($domanda) ?>?</h3>
    <input type="radio" name="risposta" value="0">
    <label for="risposta"><?= ($risposta0) ?></label><br>

    <input type="radio" name="risposta" value="1">
    <label for="risposta"><?= ($risposta1) ?></label><br>

    <input type="radio" name="risposta" value="2">
    <label for="risposta"><?= ($risposta2) ?></label><br>

    <input type="radio" name="risposta" value="3">
    <label for="risposta"><?= ($risposta3) ?></label><br>

    <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">REGISTRA LA RISPOSTA</button>
</form>