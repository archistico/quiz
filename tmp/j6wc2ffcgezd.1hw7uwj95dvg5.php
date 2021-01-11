<form method="POST" action="<?= ($BASE) ?><?= (Base::instance()->alias('domanderegistra')) ?>">
    <div class="form-group">
        <label for="materia">Materia</label>
        <select class="form-control" id="materia" name="materia" required>
            <?php foreach (($materie?:[]) as $m): ?>
                <option value="<?= ($m['nome']) ?>"><?= ($m['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="domanda">Domanda (non mettere il punto interrogativo)</label>
        <textarea class="form-control" id="domanda" name="domanda" rows="3" placeholder="Inserisci il testo corrispondente" required></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaesatta">Risposta esatta</label>
        <textarea class="form-control" id="rispostaesatta" name="rispostaesatta" rows="3" placeholder="Inserisci il testo corrispondente" required></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaerrata1">Risposta errata 1</label>
        <textarea class="form-control" id="rispostaerrata1" name="rispostaerrata1" rows="3" placeholder="Inserisci il testo corrispondente" required></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaerrata2">Risposta errata 2</label>
        <textarea class="form-control" id="rispostaerrata2" name="rispostaerrata2" rows="3" placeholder="Inserisci il testo corrispondente" required></textarea>
    </div>
    <div class="form-group">
        <label for="rispostaerrata3">Risposta errata 3</label>
        <textarea class="form-control" id="rispostaerrata3" name="rispostaerrata3" rows="3" placeholder="Inserisci il testo corrispondente" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTRA DOMANDA</button>
</form>