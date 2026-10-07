<?php
// 1. INIZIALIZZAZIONE VARIABILI E DATI (La logica va sempre in cima)
// In PHP non serve dichiarare il tipo di variabile (int, String, boolean)
$titoloPagina = "Dashboard Tecnologie ITT";
$annoScolastico = "2026"; // Stringa
$inCorso = true;          // Booleano

/*
 * 2. ARRAY ASSOCIATIVI
 * Struttura dati fondamentale: una mappa chiave-valore.
 */
$tecnologie = [
    "HTML5" => [
        "tipo" => "Linguaggio di Markup",
        "difficolta" => 2     // Intero
    ],
    "CSS3"  => [
        "tipo" => "Linguaggio di Stile",
        "difficolta" => 3     // Intero
    ],
    "PHP 8" => [
        "tipo" => "Scripting Server-Side",
        "difficolta" => "4"   // Stringa! PHP la convertirà in automatico durante la somma
    ],
    "MySQL" => [
        "tipo" => "Database Relazionale",
        "difficolta" => "4"   // Stringa!
    ]
];

// 3. FUNZIONI E TYPE JUGGLING
/**
 * Calcola la media della difficoltà delle tecnologie.
 * Non usiamo la tipizzazione: sfruttiamo la natura dinamica di PHP.
 */
function calcolaDifficoltaMedia($dati) {
    // La funzione empty() verifica se una variabile è vuota o non esiste
    if (empty($dati)) {
        return 0;
    }

    $somma = 0;
    foreach ($dati as $tech) {
        // PHP converte in automatico le stringhe numeriche in interi per fare l'addizione
        $somma += $tech['difficolta'];
    }

    return $somma / count($dati);
}

// 4. ELABORAZIONE DATI
$media = calcolaDifficoltaMedia($tecnologie);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titoloPagina) ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 60%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #0056b3; color: white; }
        .difficile { background-color: #ffebee; color: #c62828; font-weight: bold; }
    </style>
</head>
<body>

<!-- Uso di htmlspecialchars() per sicurezza (Prevenzione XSS di base) -->
<h1><?= htmlspecialchars($titoloPagina) ?></h1>

<!-- Sintassi alternativa di IF per separazione netta tra PHP e HTML -->
<?php if ($inCorso): ?>
    <p><em>Anno Scolastico: <?= $annoScolastico ?>/<?= $annoScolastico + 1 ?></em></p>
<?php endif; ?>

<p>Difficoltà media del programma: <strong><?= number_format($media, 1, ',', '.') ?> / 5</strong></p>

<table>
    <thead>
    <tr>
        <th>Tecnologia</th>
        <th>Tipologia</th>
        <th>Difficoltà (1-5)</th>
    </tr>
    </thead>
    <tbody>
    <!-- Sintassi alternativa del FOREACH per creare le righe della tabella -->
    <?php foreach ($tecnologie as $nomeTech => $dettagli): ?>

        <?php
        // Logica di vista: se la difficoltà > 3, applica la classe CSS 'difficile'
        // Anche qui PHP fa il casting automatico per confrontare una stringa con l'intero 3
        $classeCss = ($dettagli['difficolta'] > 3) ? 'difficile' : '';
        ?>

        <tr class="<?= $classeCss ?>">
            <td><?= htmlspecialchars($nomeTech) ?></td>
            <td><?= htmlspecialchars($dettagli['tipo']) ?></td>
            <td><?= $dettagli['difficolta'] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>