<form method="POST">
    <div class="form-group">
        <label for="nome">Scrivi il tuo nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="" required>
    </div>
    <input type="hidden" name="numero_domande" value="<?= ($domande) ?>">
    <input type="hidden" name="materia" value="<?= ($materia) ?>">
    <button type="submit" class="btn btn-primary btn-lg btn-block">INIZIA LA PROVA DA <?= ($domande) ?> DOMANDE</button>
</form>