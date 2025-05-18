<?php
session_start();

// Collect players from POST
$players = [];
for ($i = 1; $i <= 3; $i++) {
    $nameKey = "player{$i}_ime";
    $usernameKey = "player{$i}_uporabnisko_ime";
    if (!empty($_POST[$nameKey]) && !empty($_POST[$usernameKey])) {
        $players[] = [
            'ime' => htmlspecialchars(trim($_POST[$nameKey])),
            'uporabnisko_ime' => htmlspecialchars(trim($_POST[$usernameKey]))
        ];
    }
}

if (count($players) === 0) {
    echo "<p>No player data provided. Please go back and fill out the form.</p>";
    exit;
}

$stKock = isset($_POST['stKock']) && intval($_POST['stKock']) > 0 ? intval($_POST['stKock']) : 1;
$stIger = isset($_POST['stIger']) && intval($_POST['stIger']) > 0 ? intval($_POST['stIger']) : 1;

if (!isset($_SESSION['game_results'])) {
    $_SESSION['game_results'] = [];
    $_SESSION['current_game'] = 0;
    $_SESSION['totalSums'] = array_fill(0, count($players), 0);
}

if ($_SESSION['current_game'] === 0 && empty($_SESSION['game_results'])) {
    $_SESSION['totalSums'] = array_fill(0, count($players), 0);
}

$currentGame = $_SESSION['current_game'];

if ($currentGame < $stIger) {
    $gameResult = [];
    for ($p = 0; $p < count($players); $p++) {
        $diceRolls = [];
        $sum = 0;
        for ($d = 0; $d < $stKock; $d++) {
            $roll = rand(1, 6);
            $diceRolls[] = $roll;
            $sum += $roll;
        }
        $gameResult[$p] = ['dice' => $diceRolls, 'sum' => $sum];
        $_SESSION['totalSums'][$p] += $sum;
    }
    $_SESSION['game_results'][] = $gameResult;
}

$totalSums = $_SESSION['totalSums'];
$currentGame++;
$isLastGame = $currentGame >= $stIger;
?>
<!DOCTYPE html>
<html lang="sl-SI">
<head>
    <meta charset="UTF-8">
    <title>Gambling Room</title>
    <link rel="stylesheet" href="../CSS/style2.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <section id="title">
        <h1 id="titletext">Gambling Room</h1>
    </section>

    <?php
    $game = $_SESSION['game_results'][$currentGame - 1];
    foreach ($players as $idx => $player) {
        echo '<div class="player-result">';
        echo '<h3>' . $player['ime'] . ' (' . $player['uporabnisko_ime'] . ')</h3>';
        echo '<div class="dice-grid">';
        foreach ($game[$idx]['dice'] as $roll) {
            $imageName = '';
            switch ($roll) {
                case 1: $imageName = 'diceEna.png'; break;
                case 2: $imageName = 'diceDva.png'; break;
                case 3: $imageName = 'diceTri.png'; break;
                case 4: $imageName = 'diceStiri.png'; break;
                case 5: $imageName = 'dicePet.png'; break;
                case 6: $imageName = 'diceSest.png'; break;
            }
            echo "<img src='../img/{$imageName}' alt='dice {$roll}'>";
        }
        echo '</div>';
        echo '<p>Vsota: ' . $game[$idx]['sum'] . '</p>';
        echo '</div>';
    }
    ?>

    <?php if (!$isLastGame): ?>
        <form method="post" action="result.php">
            <?php foreach ($_POST as $key => $val): ?>
                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($val) ?>">
            <?php endforeach; ?>
            <button id="playNextGameBtn" type="submit">Vrzi</button>
        </form>
    <?php else: ?>
        <div id="finalTotals">
            <h2>Končne uvrstitve</h2>
            <?php
            // Prepare and sort players by total score descending
            $rankedPlayers = $players;
            foreach ($rankedPlayers as $key => $player) {
                $rankedPlayers[$key]['score'] = $totalSums[$key];
            }
            usort($rankedPlayers, function($a, $b) {
                return $b['score'] - $a['score'];
            });

            $places = ['Prvo mesto', 'Drugo mesto', 'Tretje mesto'];

            for ($i = 0; $i < count($rankedPlayers); $i++) {
                $place = isset($places[$i]) ? $places[$i] : ($i + 1) . '. mesto';
                echo '<p><strong>' . $place . '</strong>: ' . $rankedPlayers[$i]['ime'] .
                     ' (' . $rankedPlayers[$i]['uporabnisko_ime'] . ') – ' . $rankedPlayers[$i]['score'] . ' točk</p>';
            }
            ?>
        </div>
        <?php
        // Reset session after game ends
        $_SESSION['current_game'] = 0;
        $_SESSION['game_results'] = [];
        $_SESSION['totalSums'] = [];
        ?>
    <?php endif; ?>

    <script src="../JS/redirect.js"></script>
</body>
</html>
<?php
if (!$isLastGame) {
    $_SESSION['current_game']++;
}
?>