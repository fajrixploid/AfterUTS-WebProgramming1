
document.addEventListener("DOMContentLoaded", function () {
    const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2 MB

    const form = document.querySelector("[data-media-form]");
    const fotoInput = document.getElementById("foto");
    const audioInput = document.getElementById("audio");
    const dokumenInput = document.getElementById("dokumen");

    const previewFoto = document.getElementById("previewFoto");
    const previewAudio = document.getElementById("previewAudio");
    const previewDokumen = document.getElementById("previewDokumen");

    let fotoURL = null;
    let audioURL = null;

    // Preview foto
    if (fotoInput && previewFoto) {
        fotoInput.addEventListener("change", function () {
            const file = this.files[0];

            if (!file) {
                previewFoto.hidden = true;
                return;
            }

            if (!["image/jpeg", "image/png", "image/webp"].includes(file.type)) {
                alert("Foto harus JPG, PNG, atau WebP.");
                this.value = "";
                previewFoto.hidden = true;
                return;
            }

            if (file.size > MAX_FILE_SIZE) {
                alert("Ukuran foto maksimal 2 MB.");
                this.value = "";
                previewFoto.hidden = true;
                return;
            }

            if (fotoURL) URL.revokeObjectURL(fotoURL);

            fotoURL = URL.createObjectURL(file);
            previewFoto.src = fotoURL;
            previewFoto.hidden = false;
        });
    }

    // Preview audio
    if (audioInput && previewAudio) {
        audioInput.addEventListener("change", function () {
            const file = this.files[0];

            if (!file) {
                previewAudio.hidden = true;
                return;
            }

            if (!file.type.startsWith("audio/")) {
                alert("File harus berupa audio.");
                this.value = "";
                previewAudio.hidden = true;
                return;
            }

            if (file.size > MAX_FILE_SIZE) {
                alert("Ukuran audio maksimal 2 MB.");
                this.value = "";
                previewAudio.hidden = true;
                return;
            }

            if (audioURL) URL.revokeObjectURL(audioURL);

            audioURL = URL.createObjectURL(file);
            previewAudio.src = audioURL;
            previewAudio.hidden = false;
        });
    }

    // Preview dokumen PDF
    if (dokumenInput && previewDokumen) {
        dokumenInput.addEventListener("change", function () {
            const file = this.files[0];

            if (!file) {
                previewDokumen.textContent = "Belum ada dokumen dipilih.";
                return;
            }

            if (file.type !== "application/pdf") {
                alert("Dokumen harus berupa PDF.");
                this.value = "";
                previewDokumen.textContent = "Belum ada dokumen dipilih.";
                return;
            }

            if (file.size > MAX_FILE_SIZE) {
                alert("Ukuran dokumen maksimal 2 MB.");
                this.value = "";
                previewDokumen.textContent = "Belum ada dokumen dipilih.";
                return;
            }

            previewDokumen.textContent =
                file.name + " - " + Math.round(file.size / 1024) + " KB";
        });
    }

    // Validasi form
    if (form) {
        form.addEventListener("submit", function (event) {
            const fields = [
                ["nim", "errorNim", "NIM wajib diisi."],
                ["nama", "errorNama", "Nama wajib diisi."],
                ["program_studi", "errorProdi", "Program studi wajib diisi."],
                ["email", "errorEmail", "Email tidak valid."]
            ];

            let valid = true;

            document.querySelectorAll(".form-error").forEach(el => {
                el.textContent = "";
            });

            document.querySelectorAll(".is-invalid").forEach(el => {
                el.classList.remove("is-invalid");
            });

            fields.forEach(([id, errorId, message]) => {
                const input = document.getElementById(id);
                const error = document.getElementById(errorId);

                const invalid = !input ||
                    input.value.trim() === "" ||
                    (id === "email" && !input.checkValidity());

                if (invalid) {
                    if (error) error.textContent = message;
                    if (input) input.classList.add("is-invalid");
                    valid = false;
                }
            });

            if (
                form.dataset.requireFoto === "true" &&
                (!fotoInput || fotoInput.files.length === 0)
            ) {
                const error = document.getElementById("errorFoto");
                if (error) error.textContent = "Foto wajib dipilih.";
                valid = false;
            }

            if (!valid) {
                event.preventDefault();
                alert("Form belum valid. Periksa kembali input Anda.");
            }
        });
    }

    // Konfirmasi hapus
    document.querySelectorAll(".media-delete-form").forEach(formDelete => {
        formDelete.addEventListener("submit", function (event) {
            if (!confirm("Data dan file media terkait akan dihapus. Lanjutkan?")) {
                event.preventDefault();
            }
        });
    });

    // Search data media
    const searchMedia = document.getElementById("searchMedia");
    const mediaRows = document.querySelectorAll("#mediaTable tbody tr");

    if (searchMedia) {
        searchMedia.addEventListener("input", function () {
            const keyword = this.value.toLowerCase().trim();

            mediaRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(keyword) ? "" : "none";
            });
        });
    }

    // Notifikasi setelah proses
    const params = new URLSearchParams(window.location.search);
    const status = params.get("status");

    if (status === "tambah") alert("Data media berhasil ditambahkan.");
    if (status === "update") alert("Data media berhasil diperbarui.");
    if (status === "hapus") alert("Data media berhasil dihapus.");
});
