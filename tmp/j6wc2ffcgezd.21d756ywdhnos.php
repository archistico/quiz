<form action="/">
    <p><?= ($domanda) ?>?</p>
    <?php foreach (($risposte?:[]) as $risposta): ?>
        <input type="radio" id="<?= ($risposta['id']) ?>" name="risposta" value="">
        <label for="<?= ($risposta['id']) ?>"><?= ($risposta['testo']) ?></label><br>
    <?php endforeach; ?>
  </form>

