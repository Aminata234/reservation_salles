<h1><?= htmlspecialchars($salle->nom, ENT_QUOTES, 'UTF-8') ?></h1>

<p>
    Bâtiment :
    <?= htmlspecialchars($salle->batiment, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    Capacité :
    <?= htmlspecialchars((string) $salle->capacite, ENT_QUOTES, 'UTF-8') ?>
    personnes
</p>

<p>
    Type :
    <?= htmlspecialchars($salle->type, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    Statut :
    <?= $salle->active ? 'Active' : 'Inactive' ?>
</p>

<a href="/salles">Retour à la liste</a>