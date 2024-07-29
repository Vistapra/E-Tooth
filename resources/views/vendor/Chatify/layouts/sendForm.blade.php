<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        .messenger-sendCard {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .help-text-container {
            margin-bottom: 10px;
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            gap: 10px;
        }

        .help-text {
            padding: 10px;
            background-color: #e7f1ff;
            border: 1px solid #b3d4fc;
            border-radius: 4px;
            color: #007bff;
            cursor: pointer;
            flex: 0 0 auto;
            box-sizing: border-box;
        }

        .help-text:hover {
            background-color: #d0e6ff;
        }

        .send-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="messenger-sendCard">
        <div class="help-text-container">
            <div id="help-text-1" class="help-text" data-to-id="1">Konsultasi Dengan Dokter</div>
            <div id="help-text-2" class="help-text" data-to-id="2">Informasi Produk</div>
            <div id="help-text-3" class="help-text" data-to-id="3">Penjadwalan Janji</div>
            <div id="help-text-4" class="help-text" data-to-id="4">Perbaikan Akun</div>
            <div id="help-text-5" class="help-text" data-to-id="5">Feedback & Saran</div>
            <div id="help-text-6" class="help-text" data-to-id="6">Support Teknis</div>
            <div id="help-text-7" class="help-text" data-to-id="7">FAQ & Panduan</div>
            <div id="help-text-8" class="help-text" data-to-id="8">Hubungi Kami</div>
        </div>

        <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="to_id" id="to_id" value="">
            <!-- Field tersembunyi untuk to_id -->
            <label>
                <span class="fas fa-plus-circle"></span>
                <input type="file" class="upload-attachment" name="file"
                    accept=".{{ implode(', .', config('chatify.attachments.allowed_images')) }}, .{{ implode(', .', config('chatify.attachments.allowed_files')) }}" />
            </label>
            <button type="button" class="emoji-button">
                <span class="fas fa-smile"></span>
            </button>
            <textarea name="message" class="m-send app-scroll" placeholder="Ketikkan pesan Anda di sini.."></textarea>
            <button type="submit" class="send-button" disabled>
                <span class="fas fa-paper-plane"></span>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpTexts = document.querySelectorAll('.help-text');
            const messageForm = document.getElementById('message-form');
            const textarea = document.querySelector('textarea[name="message"]');

            helpTexts.forEach(helpText => {
                helpText.addEventListener('click', () => {
                    // Menambahkan teks bantuan ke dalam textarea
                    textarea.value = helpText.textContent.trim();

                    // Mengatur nilai to_id dari atribut data-to-id
                    toIdField.value = helpText.getAttribute('data-to-id');

                    // Cek nilai to_id dan textarea
                    console.log('to_id:', toIdField.value);
                    console.log('Message:', textarea.value);

                    // Validasi jika to_id dan textarea tidak kosong
                    if (toIdField.value && textarea.value.trim()) {
                        // Mengirimkan form
                        messageForm.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
