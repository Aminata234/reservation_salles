<h1>Créer une salle</h1>

<form method="POST" action="/salles">

    <div>
        <label for="nom">Nom</label>

        <input
            type="text"
            id="nom"
            name="nom"
            value="<?= htmlspecialchars($data['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['nom'])): ?>
            <p>
                <?= htmlspecialchars($errors['nom'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="batiment">Bâtiment</label>

        <input
            type="text"
            id="batiment"
            name="batiment"
            value="<?= htmlspecialchars($data['batiment'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['batiment'])): ?>
            <p>
                <?= htmlspecialchars($errors['batiment'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="capacite">Capacité</label>

        <input
            type="number"
            id="capacite"
            name="capacite"
            value="<?= htmlspecialchars((string) ($data['capacite'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
        >

        <?php if (isset($errors['capacite'])): ?>
            <p>
                <?= htmlspecialchars($errors['capacite'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label for="type">Type</label>

        <select id="type" name="type">
            <option value="">Choisir un type</option>
            <option value="cours">Cours</option>
            <option value="informatique">Informatique</option>
            <option value="laboratoire">Laboratoire</option>
            <option value="amphitheatre">Amphithéâtre</option>
            <option value="reunion">Réunion</option>
        </select>

        <?php if (isset($errors['type'])): ?>
            <p>
                <?= htmlspecialchars($errors['type'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>

    <div>
        <label>
            <input type="checkbox" name="active" value="1">
            Salle active
        </label>
    </div>

    <button type="submit">Enregistrer</button>

</form>