<h2>Esame di <?= ($nome) ?> del <?= ($fattoil) ?></h2>
<h3>Voto finale: <?= ($votazione) ?></h3>
<hr>
<h4>Domande e risposte</h4>
<table>
    <?php foreach (($domande?:[]) as $d): ?>
        <tr>
            <td>#<?= ($d['numero']) ?></td>
            <td><strong>Domanda: <?= ($d['domanda']) ?>?</strong></td>
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta0']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta0']==$d['risposta']): ?>
                        
                            <td class="bg-success">Risposta: <?= ($d['risposta0']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">Risposta: <?= ($d['risposta0']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta0']==$d['risposta']): ?>
                        
                            <td class="bg-danger">Risposta: <?= ($d['risposta0']) ?></td>
                        
                        <?php else: ?>
                            <td>Risposta: <?= ($d['risposta0']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>            
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta1']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta1']==$d['risposta']): ?>
                        
                            <td class="bg-success">Risposta: <?= ($d['risposta1']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">Risposta: <?= ($d['risposta1']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta1']==$d['risposta']): ?>
                        
                            <td class="bg-danger">Risposta: <?= ($d['risposta1']) ?></td>
                        
                        <?php else: ?>
                            <td>Risposta: <?= ($d['risposta1']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta2']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta2']==$d['risposta']): ?>
                        
                            <td class="bg-success">Risposta: <?= ($d['risposta2']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">Risposta: <?= ($d['risposta2']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta2']==$d['risposta']): ?>
                        
                            <td class="bg-danger">Risposta: <?= ($d['risposta2']) ?></td>
                        
                        <?php else: ?>
                            <td>Risposta: <?= ($d['risposta2']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>
        </tr>
        <tr>
            <td></td>
            <?php if ($d['risposta3']==$d['risposta_corretta']): ?>
                
                    <?php if ($d['risposta3']==$d['risposta']): ?>
                        
                            <td class="bg-success">Risposta: <?= ($d['risposta3']) ?></td>
                        
                        <?php else: ?>
                            <td class="bg-success">Risposta: <?= ($d['risposta3']) ?></td>
                        
                    <?php endif; ?>
                
                <?php else: ?>
                    <?php if ($d['risposta3']==$d['risposta']): ?>
                        
                            <td class="bg-danger">Risposta: <?= ($d['risposta3']) ?></td>
                        
                        <?php else: ?>
                            <td>Risposta: <?= ($d['risposta3']) ?></td>
                        
                    <?php endif; ?>
                
            <?php endif; ?>
        </tr>
        <tr>
            <td></td>
            <td><?= ($d['verifica']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
