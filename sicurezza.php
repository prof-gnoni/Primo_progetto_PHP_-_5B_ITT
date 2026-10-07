<?php
// Simuliamo un dato malevolo inserito da un utente (es. tramite form o database)
$inputMalevolo = "<script>alert('Sito hackerato! 🏴‍☠️');</script> <b>Testo in grassetto</b>";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Test Sicurezza XSS</title>
    <style>
        .box { border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; }
        .danger { border-color: red; background-color: #ffebee; }
        .safe { border-color: green; background-color: #e8f5e9; }
    </style>
</head>
<body>
<h1>Test di stampa variabili</h1>

<div class="box danger">
    <h3>1. Stampa NON sicura (Vulnerabile a XSS)</h3>
    <p>Se togli il commento alla riga sotto, il browser eseguirà l'alert JavaScript!</p>
    <?php
    // ATTENZIONE: Decommentare solo per scopo didattico!
    // echo $inputMalevolo;
    ?>
</div>

<div class="box safe">
    <h3>2. Stampa SICURA (Escaping corretto)</h3>
    <p>Il codice malevolo viene neutralizzato e stampato come semplice testo:</p>
    <?php
    /*
     * Dalla versione PHP 8.1, htmlspecialchars usa di default i flag:
     * ENT_QUOTES (converte sia apici singoli che doppi)
     * ENT_SUBSTITUTE (sostituisce i caratteri non validi)
     * Non è più necessario specificarli a mano nella maggior parte dei casi.
     */
    echo htmlspecialchars($inputMalevolo);
    ?>
</div>
</body>
</html>