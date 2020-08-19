<?php foreach (($lista_domande?:[]) as $l): ?>
    <a href="<?= ($BASE) ?>/esame/<?= ($idesame) ?>/<?= ($l['domanda']) ?>"><?= ($l['numero']) ?></a> |
<?php endforeach; ?>
<hr>
<form method="POST">

    <h3><?= ($numero_domanda) ?>) <?= ($domanda) ?>?</h3>

    <div class="form-check">
        <input class="form-check-input"  type="radio" name="risposta" value="0" id="risposta0">
        <label class="form-check-label" for="risposta0"><?= ($risposta0) ?></label>
    </div>

    <div class="form-check">
        <input class="form-check-input"  type="radio" name="risposta" value="1" id="risposta1">
        <label class="form-check-label" for="risposta1"><?= ($risposta1) ?></label>
    </div>

    <div class="form-check">
        <input class="form-check-input"  type="radio" name="risposta" value="2" id="risposta2">
        <label class="form-check-label" for="risposta2"><?= ($risposta2) ?></label>
    </div>

    <div class="form-check">
        <input class="form-check-input"  type="radio" name="risposta" value="3" id="risposta3">
        <label class="form-check-label" for="risposta3"><?= ($risposta3) ?></label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">REGISTRA LA RISPOSTA</button>
</form>