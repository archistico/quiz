<h2><strong>Esame di <?= ($nome) ?> del <?= ($fattoil) ?></strong></h2>
<p>Ogni corretta: +<?= ($ricavo_corrette) ?> | Ogni sbagliata: -<?= ($costo_sbagliate) ?><br>
Risposte corrette: <?= ($corrette) ?><br>
Risposte sbagliate: <?= ($sbagliate) ?></p>
<h3><strong>Voto finale: <?= ($votazione) ?></strong></h3>
<hr>
<h4>Domande e risposte</h4>
<table>
    <?php foreach (($domande?:[]) as $d): ?>
        <tr>
            <td>#<?= ($d['numero']) ?></td>
            <td>D: <strong><?= ($d['domanda']) ?>?</strong></td>
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta0']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta0']==$d['risposta']): ?>
                        
                            <td class="bg-success">R: <?= ($d['risposta0']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">R: <?= ($d['risposta0']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta0']==$d['risposta']): ?>
                        
                            <td class="bg-danger">R: <?= ($d['risposta0']) ?></td>
                        
                        <?php else: ?>
                            <td>R: <?= ($d['risposta0']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>            
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta1']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta1']==$d['risposta']): ?>
                        
                            <td class="bg-success">R: <?= ($d['risposta1']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">R: <?= ($d['risposta1']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta1']==$d['risposta']): ?>
                        
                            <td class="bg-danger">R: <?= ($d['risposta1']) ?></td>
                        
                        <?php else: ?>
                            <td>R: <?= ($d['risposta1']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta2']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta2']==$d['risposta']): ?>
                        
                            <td class="bg-success">R: <?= ($d['risposta2']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">R: <?= ($d['risposta2']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta2']==$d['risposta']): ?>
                        
                            <td class="bg-danger">R: <?= ($d['risposta2']) ?></td>
                        
                        <?php else: ?>
                            <td>R: <?= ($d['risposta2']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta3']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta3']==$d['risposta']): ?>
                        
                            <td class="bg-success">R: <?= ($d['risposta3']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">R: <?= ($d['risposta3']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta3']==$d['risposta']): ?>
                        
                            <td class="bg-danger">R: <?= ($d['risposta3']) ?></td>
                        
                        <?php else: ?>
                            <td>R: <?= ($d['risposta3']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>
        </tr>
        <tr>
            <td></td>
            <td><?= ($d['verifica']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
