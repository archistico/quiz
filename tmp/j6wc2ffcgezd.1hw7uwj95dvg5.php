<form method="POST">
    <div class="form-group">
        <label for="materia">Materia</label>
        <select class="form-control" id="materia">
            <?php foreach (($materie?:[]) as $m): ?>
                <option value="<?= ($m) ?>"><?= ($m) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="domanda">Domanda</label>
        <textarea class="form-control" id="domanda" rows="3" placeholder="Inserisci il testo corrispondente"></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaesatta">Risposta esatta</label>
        <textarea class="form-control" id="rispostaesatta" rows="3" placeholder="Inserisci il testo corrispondente"></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaerrata1">Risposta errata 1</label>
        <textarea class="form-control" id="rispostaerrata1" rows="3" placeholder="Inserisci il testo corrispondente"></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaerrata2">Risposta errata 2</label>
        <textarea class="form-control" id="rispostaerrata2" rows="3" placeholder="Inserisci il testo corrispondente"></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaerrata3">Risposta errata 3</label>
        <textarea class="form-control" id="rispostaerrata3" rows="3" placeholder="Inserisci il testo corrispondente"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary btn-lg btn-block">INIZIA LA PROVA DA <?= ($domande) ?> DOMANDE</button>
</form>