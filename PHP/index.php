<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sl-SI">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Gambling Room</title>
</head>

<body>
    <form id="forma" method="post" action="result.php">
        <section id="title">
            <h1 id="titletext">Gambling Room</h1>
        </section>
        <section id="controll">
            <div id="add">
            </div>
            <div id="sub">
            </div>
        </section>
        <section id="playerFormEna">
            <div class="formTitle">
                <h2>Igralec 1</h2>
            </div>
            <span>Ime </span><input type="text" size="20" name="player1_ime">
            <span>Uporabniško ime </span><input type="text" size="30" name="player1_uporabnisko_ime">
        </section>
        <section id="playerFormDva">
            <div class="formTitle">
                <h2>Igralec 2</h2>
            </div>
            <span>Ime </span><input type="text" size="20" name="player2_ime">
            <span>Uporabniško ime </span><input type="text" size="30" name="player2_uporabnisko_ime">
        </section>
        <section id="playerFormTri">
            <div class="formTitle">
                <h2>Igralec 3</h2>
            </div>
            <span>Ime </span><input type="text" size="20"name="player3_ime">
            <span>Uporabniško ime </span><input type="text" size="30" name="player3_uporabnisko_ime">
        </section>
        <section id="gameForm">
            <span>Število kock </span><input type="number" size="20" name="stKock">
            <span>Število iger </span><input type="number" size="30" name="stIger">
        </section>
        <section id="igraj">
            <button type="submit" title="Igraj" id="gumb">Igraj</button>
        </section>
    </form>
    <script src="../JS/index.js"></script>
</body>

</html>