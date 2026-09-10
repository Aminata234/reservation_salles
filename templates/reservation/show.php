<h1>Détail de la réservation</h1>

<p>
    Responsable :
    <?= htmlspecialchars(
        $reservation->responsable,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    Email :
    <?= htmlspecialchars(
        $reservation->email,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    Motif :
    <?= htmlspecialchars(
        $reservation->motif,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    Début :
    <?= htmlspecialchars(
        $reservation->date_debut->format('d/m/Y H:i'),
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    Fin :
    <?= htmlspecialchars(
        $reservation->date_fin->format('d/m/Y H:i'),
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<p>
    Statut :
    <?= htmlspecialchars(
        $reservation->statut,
        ENT_QUOTES,
        'UTF-8'
    ) ?>
</p>

<a href="/reservations">Retour à la liste</a>