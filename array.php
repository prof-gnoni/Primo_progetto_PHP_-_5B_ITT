<?php
// --- 1. LOGICA E DATI IN CIMA AL FILE ---

// Array Indicizzato Classico (gli indici sono 0, 1, 2... assegnati in automatico)
$materie = ["Informatica", "Sistemi e Reti", "TPSIT"];

// Array Associativo (Scegliamo NOI gli indici, chiamandoli "Chiavi")
$votiClasse = [
    "Rossi"   => 7,
    "Bianchi" => 4,  // Insufficiente
    "Verdi"   => 8,
    "Neri"    => 6
];

// Calcolo della media della classe
$sommaVoti = 0;

// Se mi interessa solo il VALORE (il voto), posso usare il foreach base
foreach ($votiClasse as $voto) {
    $sommaVoti += $voto;
}

$numeroStudenti = count($votiClasse);
$media = 0;
if ($numeroStudenti > 0) {
    $media = $sommaVoti / $numeroStudenti;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Elettronico - 5A ITT</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 300px; margin-top: 10px; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .insufficiente { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h1>Registro Elettronico</h1>

<h2>Materie del corso</h2>
<ul>
    <!-- Iterazione su un array classico: mi basta l'elemento -->
    <?php foreach ($materie as $materia): ?>
        <li><?= htmlspecialchars($materia) ?></li>
    <?php endforeach; ?>
</ul>

<h2>Voti Informatica</h2>
<p>Media della classe: <strong><?= number_format($media, 2, ',', '.') ?></strong></p>

<table>
    <thead>
    <tr>
        <th>Studente</th>
        <th>Voto</th>
    </tr>
    </thead>
    <tbody>
    <!--
      Iterazione su un array associativo:
      Mi servono sia la CHIAVE ($cognome) che il VALORE ($voto)
    -->
    <?php foreach ($votiClasse as $cognome => $voto): ?>

        <?php
        // Logica di stile: se il voto è < 6, preparo la classe CSS
        $classeCss = ($voto < 6) ? 'insufficiente' : '';
        ?>

        <tr>
            <!-- Stampo la CHIAVE -->
            <td><?= htmlspecialchars($cognome) ?></td>

            <!-- Stampo il VALORE applicando l'eventuale classe CSS -->
            <td class="<?= $classeCss ?>"><?= $voto ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>