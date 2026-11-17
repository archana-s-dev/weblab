<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .calculator-card {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(16, 42, 67, 0.1);
        }

        h2 {
            text-align: center;
            color: #102a43;
            font-size: 1.5rem;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .subtitle {
            text-align: center;
            color: #627d98;
            font-size: 0.85rem;
            margin-bottom: 24px;
        }

        .inputs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 16px;
        }

        .input-group {
            margin-bottom: 0;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #486581;
            margin-bottom: 6px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            font-size: 1rem;
            color: #102a43;
            background-color: #f8fafc;
            border: 2px solid #d9e2ec;
            border-radius: 8px;
            text-align: right;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background-color: #3b82f6;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        button[type="submit"]:hover {
            background-color: #2563eb;
        }

        button[type="submit"]:active {
            transform: scale(0.99);
        }

        .results-container {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #627d98;
            font-weight: 700;
            margin: 14px 0 8px 0;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        .results-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .result-label {
            color: #486581;
            font-weight: 500;
        }

        .result-value {
            color: #102a43;
            font-weight: 700;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

<div class="calculator-card">
    <h2>Scientific Calculator</h2>
    <p class="subtitle">Single-value functions compute using Value 1 (angles in degrees)</p>
    
    <form method="post">
        <div class="inputs-grid">
            <div class="input-group">
                <label for="num1">Value 1 (x)</label>
                <input type="text" id="num1" name="num1" placeholder="0" value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" />
            </div>

            <div class="input-group">
                <label for="num2">Value 2 (y)</label>
                <input type="text" id="num2" name="num2" placeholder="Optional" value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" />
            </div>
        </div>

        <button type="submit" name="submit">Calculate</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];

        if (is_numeric($num1)) {
            $x = (float)$num1;
            $hasY = is_numeric($num2);
            $y = $hasY ? (float)$num2 : null;

            // Two-value operations
            $add  = $hasY ? round($x + $y, 6) : "Need y";
            $sub  = $hasY ? round($x - $y, 6) : "Need y";
            $mul  = $hasY ? round($x * $y, 6) : "Need y";
            $div  = !$hasY ? "Need y" : ($y != 0 ? round($x / $y, 6) : "Undefined");
            $pow  = $hasY ? round(pow($x, $y), 6) : "Need y";
            $mod  = !$hasY ? "Need y" : ($y != 0 ? fmod($x, $y) : "Undefined");

            // Single-value scientific operations (on x)
            $sqrt = ($x >= 0) ? round(sqrt($x), 6) : "Complex";
            $sq   = round(pow($x, 2), 6);
            $log10 = ($x > 0) ? round(log10($x), 6) : "Undefined";
            $ln    = ($x > 0) ? round(log($x), 6) : "Undefined";

            // Trig functions (converted from degrees to radians)
            $rad = deg2rad($x);
            $sin = round(sin($rad), 6);
            $cos = round(cos($rad), 6);
            $tan = (fmod(abs($x), 180) == 90) ? "Undefined" : round(tan($rad), 6);
            $inv = ($x != 0) ? round(1 / $x, 6) : "Undefined";

            echo "<div class='results-container'>";
            
            echo "<div class='section-title'>Basic &amp; Two-Value Operations (x, y)</div>";
            echo "<div class='results-grid'>";
            echo "<div class='result-row'><span class='result-label'>x + y</span><span class='result-value'>$add</span></div>";
            echo "<div class='result-row'><span class='result-label'>x &minus; y</span><span class='result-value'>$sub</span></div>";
            echo "<div class='result-row'><span class='result-label'>x &times; y</span><span class='result-value'>$mul</span></div>";
            echo "<div class='result-row'><span class='result-label'>x &divide; y</span><span class='result-value'>$div</span></div>";
            echo "<div class='result-row'><span class='result-label'>x<sup>y</sup></span><span class='result-value'>$pow</span></div>";
            echo "<div class='result-row'><span class='result-label'>x mod y</span><span class='result-value'>$mod</span></div>";
            echo "</div>";

            echo "<div class='section-title'>Scientific &amp; Trigonometry (on x)</div>";
            echo "<div class='results-grid'>";
            echo "<div class='result-row'><span class='result-label'>x&sup2;</span><span class='result-value'>$sq</span></div>";
            echo "<div class='result-row'><span class='result-label'>&radic;x</span><span class='result-value'>$sqrt</span></div>";
            echo "<div class='result-row'><span class='result-label'>sin(x&deg;)</span><span class='result-value'>$sin</span></div>";
            echo "<div class='result-row'><span class='result-label'>cos(x&deg;)</span><span class='result-value'>$cos</span></div>";
            echo "<div class='result-row'><span class='result-label'>tan(x&deg;)</span><span class='result-value'>$tan</span></div>";
            echo "<div class='result-row'><span class='result-label'>log<sub>10</sub>(x)</span><span class='result-value'>$log10</span></div>";
            echo "<div class='result-row'><span class='result-label'>ln(x)</span><span class='result-value'>$ln</span></div>";
            echo "<div class='result-row'><span class='result-label'>1 / x</span><span class='result-value'>$inv</span></div>";
            echo "</div>";

            echo "</div>";
        } else {
            echo "<script>alert('PLEASE ENTER AT LEAST A VALID VALUE 1');</script>";
        }
    }
    ?>
</div>

</body>
</html>
