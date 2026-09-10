<h1>Créer une réservation</h1>

<form method="POST" action="/reservations">

    <div>
        <label for="salle_id">Salle</label>

        <select id="salle_id" name="salle_id">
            <option value="">Choisir une salle</option>

            <?php foreach ($salles as $salle): ?>
                <option
                    value="<?= htmlspecialchars((string) $salle->id, ENT_QUOTES, 'UTF-8') ?>"
                    <?= ($data['salle_id'] ?? '') == $salle->id ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($salle->nom, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if (isset($errors['salle_id'])): ?>
            <p>
                <?= htmlspecialchars($errors['salle_id'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="responsable">Responsable</label>

        <input
            type="text"
            id="responsable"
            name="responsable"
            value="<?= htmlspecialchars($data['responsable'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['responsable'])): ?>
            <p>
                <?= htmlspecialchars($errors['responsable'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="email">Email</label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($data['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['email'])): ?>
            <p>
                <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="motif">Motif</label>

        <textarea
            id="motif"
            name="motif"
        ><?= htmlspecialchars($data['motif'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

        <?php if (isset($errors['motif'])): ?>
            <p>
                <?= htmlspecialchars($errors['motif'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="date_debut">Date de début</label>

        <input
            type="datetime-local"
            id="date_debut"
            name="date_debut"
            value="<?= htmlspecialchars($data['date_debut'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['date_debut'])): ?>
            <p>
                <?= htmlspecialchars($errors['date_debut'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="date_fin">Date de fin</label>

        <input
            type="datetime-local"
            id="date_fin"
            name="date_fin"
            value="<?= htmlspecialchars($data['date_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['date_fin'])): ?>
            <p>
                <?= htmlspecialchars($errors['date_fin'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <button type="submit">Réserver</button>

</form>