<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password dan Verifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reset Password dan Verifikasi Email</h1>
    </div>
    <div class="content">
        <p>Halo,</p>

        <p>
            Akun Anda telah dibuat oleh admin di sistem kami. Untuk
            menyelesaikan proses pendaftaran dan memverifikasi email Anda,
            silakan reset password Anda dengan mengklik tombol di bawah ini:
        </p>

        <div style="text-align: center">
            <a
                href="{{ $url . 'reset-password?token=' . $token . '&email=' . $email }}"
                class="button">
                Reset Password
            </a>
        </div>

        <p>
            Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan
            menempelkan URL berikut ke browser Anda:
        </p>
        <p>{{ $url . 'reset-password?token=' . $token . '&email=' . $email }}</p>

        <p>Harap diperhatikan:</p>
        <ul>
            <li>
                Setelah melakukan reset password, email Anda akan otomatis
                terverifikasi.
            </li>
            <li>
                Jika Anda tidak merasa mendaftar atau memiliki pertanyaan,
                silakan hubungi admin kami.
            </li>
        </ul>

        <p>Terima kasih telah bergabung dengan perusahaan kami.</p>
    </div>
    <div class="footer">
        <p>
            &copy; 2024 Nama Celebes Digital. Hak cipta dilindungi
            undang-undang.
        </p>
    </div>
</body>

</html>