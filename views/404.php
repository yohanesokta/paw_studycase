<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSTEM FAILURE - 404</title>
    <link rel="stylesheet" href="<?= URL('/public/css/404.css') ?>">
</head>
<body>

    <div class="scanlines"></div>

    <div class="terminal-window">
        <div class="terminal-header">
            <div class="dots">
                <div class="dot red"></div>
                <div class="dot yellow"></div>
                <div class="dot green"></div>
            </div>
            <div class="title">root@server:~/system/logs</div>
        </div>

        <div class="terminal-body">
            <div class="details">
                > CONNECTING TO DATABASE... [SUCCESS]<br>
                > SEARCHING FOR TARGET URL... [FAILED]<br>
                > ERROR CODE RECEIVED:
            </div>

            <div class="error-code" data-text="404">404</div>

            <div class="output-text">
                CRITICAL ERROR: PAGE OBJECT NOT FOUND
            </div>
            
            <br>
            <div class="status-bar">
                Peringatan: Halaman yang kamu cari sepertinya telah tersedot ke dalam lubang hitam atau memang belum pernah ada.
            </div>

            <br>
            <a href="<?= URL("/") ?>" class="btn-action">
                > EXECUTE_HOMEPAGE_RECOVERY.SH
            </a>
        </div>
    </div>

</body>
</html>