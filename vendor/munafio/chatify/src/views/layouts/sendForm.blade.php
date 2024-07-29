<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data"
        onsubmit="clearMessage()">
        @csrf
        <label>
            <span class="fas fa-plus-circle"></span>
            <input disabled='disabled' type="file" class="upload-attachment" name="file"
                accept=".{{ implode(', .', config('chatify.attachments.allowed_images')) }}, .{{ implode(', .', config('chatify.attachments.allowed_files')) }}" />
        </label>
        <button class="emoji-button"><span class="fas fa-smile"></span></button>
        <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Type a message..">Hallo Dokter, saya ingin konsultasi</textarea>
        <button disabled='disabled' class="send-button"><span class="fas fa-paper-plane"></span></button>
    </form>
</div>

<script>
    function clearMessage() {
        const textarea = document.querySelector('textarea[name="message"]');
        textarea.value = '';
    }
</script>
