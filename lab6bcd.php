<?php
$a = array(array(1, 2, 3), array(4, 5, 6), array(7, 8, 9));
$b = array(array(7, 8, 9), array(4, 5, 6), array(1, 2, 3));

$m = count($a);
$n = count($a[0]);
$p = count($b);
$q = count($b[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrix Operations</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            color: #1e293b;
            padding: 40px 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            font-size: 2rem;
            color: #0f172a;
            margin-bottom: 10px;
        }
        .dimensions-bar {
            display: inline-flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .badge {
            background-color: #e2e8f0;
            color: #334155;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: monospace;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card h2 {
            font-size: 1.05rem;
            color: #475569;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-align: center;
        }
        /* Mathematical Matrix Bracket Styling */
        .matrix-wrapper {
            position: relative;
            padding: 8px 16px;
            margin: auto 0;
        }
        .matrix-wrapper::before,
        .matrix-wrapper::after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            width: 10px;
            border: 2.5px solid #2563eb;
        }
        .matrix-wrapper::before {
            left: 0;
            border-right: none;
            border-radius: 4px 0 0 4px;
        }
        .matrix-wrapper::after {
            right: 0;
            border-left: none;
            border-radius: 0 4px 4px 0;
        }
        table.matrix {
            border-collapse: collapse;
        }
        table.matrix td {
            padding: 8px 14px;
            text-align: center;
            font-family: "Courier New", Courier, monospace;
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
        }
        .highlight-card {
            border-top: 4px solid #2563eb;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Matrix Operations</h1>
        <div class="dimensions-bar">
            <span class="badge">$m = <?php echo $m; ?></span>
            <span class="badge">$n = <?php echo $n; ?></span>
            <span class="badge">$p = <?php echo $p; ?></span>
            <span class="badge">$q = <?php echo $q; ?></span>
        </div>
    </header>

    <div class="grid">
        <!-- First Matrix -->
        <div class="card">
            <h2>First Matrix (A)</h2>
            <div class="matrix-wrapper">
                <table class="matrix">
                    <?php for ($row = 0; $row < $m; $row++): ?>
                        <tr>
                            <?php for ($col = 0; $col < $n; $col++): ?>
                                <td><?php echo $a[$row][$col]; ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>

        <!-- Second Matrix -->
        <div class="card">
            <h2>Second Matrix (B)</h2>
            <div class="matrix-wrapper">
                <table class="matrix">
                    <?php for ($row = 0; $row < $p; $row++): ?>
                        <tr>
                            <?php for ($col = 0; $col < $q; $col++): ?>
                                <td><?php echo $b[$row][$col]; ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>

        <!-- Transpose First Matrix -->
        <div class="card">
            <h2>Transpose of A (A<sup>T</sup>)</h2>
            <div class="matrix-wrapper">
                <table class="matrix">
                    <?php for ($row = 0; $row < $n; $row++): ?>
                        <tr>
                            <?php for ($col = 0; $col < $m; $col++): ?>
                                <td><?php echo $a[$col][$row]; ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>

        <!-- Transpose Second Matrix -->
        <div class="card">
            <h2>Transpose of B (B<sup>T</sup>)</h2>
            <div class="matrix-wrapper">
                <table class="matrix">
                    <?php for ($row = 0; $row < $q; $row++): ?>
                        <tr>
                            <?php for ($col = 0; $col < $p; $col++): ?>
                                <td><?php echo $b[$col][$row]; ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>

        <!-- Addition -->
        <?php if (($m === $p) and ($n === $q)): ?>
            <div class="card highlight-card">
                <h2>Addition (A + B)</h2>
                <div class="matrix-wrapper">
                    <table class="matrix">
                        <?php for ($row = 0; $row < $m; $row++): ?>
                            <tr>
                                <?php for ($col = 0; $col < $n; $col++): ?>
                                    <td><?php echo ($a[$row][$col] + $b[$row][$col]); ?></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Multiplication -->
        <?php if ($n === $p): ?>
            <?php
            $result = array();
            for ($i = 0; $i < $m; $i++) {
                for ($j = 0; $j < $q; $j++) {
                    $result[$i][$j] = 0;
                    for ($k = 0; $k < $n; $k++) {
                        $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
                    }
                }
            }
            ?>
            <div class="card highlight-card">
                <h2>Multiplication (A &times; B)</h2>
                <div class="matrix-wrapper">
                    <table class="matrix">
                        <?php for ($row = 0; $row < $m; $row++): ?>
                            <tr>
                                <?php for ($col = 0; $col < $q; $col++): ?>
                                    <td><?php echo $result[$row][$col]; ?></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
