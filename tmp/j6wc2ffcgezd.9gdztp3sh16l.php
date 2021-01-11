<div>
    <h2>Domande</h2>
    <a href="<?= ($BASE) ?>/domande/nuova">Aggiungi una nuova domanda</a><br>
</div>
<hr>
<?php foreach (($lista_materie?:[]) as $materia): ?>
    <div>
        <h2><?= ($materia['nome']) ?></h2>
        <a href="<?= ($BASE) ?><?= (Base::instance()->alias('domande', 'materia='.$materia['slug'])) ?>">Lista di tutte le domande</a><br>
        <a href="<?= ($BASE) ?>/muscoli-arti-inferiori/10/">Esame da 10 domande</a><br>
        <a href="<?= ($BASE) ?>/muscoli-arti-inferiori/30/">Esame da 30 domande</a><br>
    </div>
    <hr>
<?php endforeach; ?>
<div>
    <h2>Lista esami</h2>
    <table class="table table-hover">
    <?php foreach (($lista_esami?:[]) as $esame): ?>
        <tr>
            <td><?= ($esame['materia']) ?></td> 
            <td><?= ($esame['nome']) ?></td> 
            <td><?= ($esame['fattoil']) ?></td>
            <td><a href="<?= ($BASE) ?>/esame/<?= ($esame['id']) ?>/0">Rivedi</a> | <a href="<?= ($BASE) ?>/verifica/<?= ($esame['id']) ?>">Verifica</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>