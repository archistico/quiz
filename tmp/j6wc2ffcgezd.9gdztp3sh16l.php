<h1>Test - Anatomia</h1>
<hr>
<div>
    <h2>Muscoli arti inferiori</h2>
    <a href="/muscoli-arti-inferiori/10/">Esame da 10 domande</a><br>
    <a href="/muscoli-arti-inferiori/30/">Esame da 30 domande</a><br>
</div>
<hr>
<div>
    <h2>Lista esami</h2>
    <table class="table table-hover">
    <?php foreach (($lista_esami?:[]) as $esame): ?>
        <tr>
            <td><?= ($esame['nome']) ?></td> 
            <td><?= ($esame['fattoil']) ?></td>
            <td><a href="/verifica/<?= ($esame['id']) ?>">Verifica</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>