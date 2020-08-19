<h1>Test - Anatomia</h1>
<hr>
<div>
    <h2>Muscoli arti inferiori</h2>
    <a href="<?= ($BASE) ?>/domande/">Lista di tutte le domande</a><br>
    <a href="<?= ($BASE) ?>/muscoli-arti-inferiori/10/">Esame da 10 domande</a><br>
    <a href="<?= ($BASE) ?>/muscoli-arti-inferiori/30/">Esame da 30 domande</a><br>
</div>
<hr>
<div>
    <h2>Lista esami</h2>
    <table class="table table-hover">
    <?php foreach (($lista_esami?:[]) as $esame): ?>
        <tr>
            <td><?= ($esame['nome']) ?></td> 
            <td><?= ($esame['fattoil']) ?></td>
            <td><a href="<?= ($BASE) ?>/esame/<?= ($esame['id']) ?>/0">Rivedi</a> | <a href="<?= ($BASE) ?>/verifica/<?= ($esame['id']) ?>">Verifica</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>