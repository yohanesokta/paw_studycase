    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Lengkapi Data</title>
    </head>

    <body>

        <h2>Lengkapi Data Anda</h2>

        <form action="/paw_studycase/google/user-profile/save" method="POST">

            <label for="no_telepon">Nomor Telepon:</label><br>
            <input type="text" name="no_telepon" id="no_telepon"
                placeholder="Masukkan nomor telepon" required>
            <br><br>

            <label for="alamat">Alamat Lengkap:</label><br>
            <textarea name="alamat" id="alamat" rows="4"
                placeholder="Masukkan alamat lengkap" required></textarea>
            <br><br>

            <button type="submit">Simpan</button>

        </form>

    </body>

    </html>