<h1>Liste des réservations</h1>

<?php if (empty($reservations)): ?>

    <p>Aucune réservation disponible.</p>

<?php else: ?>

    <ul>
        <?php foreach ($reservations as $reservation): ?>
            <li>
                <?= htmlspecialchars($reservation->responsable, ENT_QUOTES, 'UTF-8') ?>

                -
                
                <?= htmlspecialchars(
                    $reservation->motif,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>