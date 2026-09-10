<h1>Liste des salles</h1>

<?php if (empty($salles)): ?>

    <p>Aucune salle disponible.</p>

<?php else: ?>

    <ul>
        <?php foreach ($salles as $salle): ?>
            <li>
                <?= htmlspecialchars($salle->nom, ENT_QUOTES, 'UTF-8') ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>