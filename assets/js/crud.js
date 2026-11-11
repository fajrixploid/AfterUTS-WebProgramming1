document.addEventListener("DOMContentLoaded", function () {
 const form = document.querySelector("[data-crud-form]");
 if (form) {
 form.addEventListener("submit", function (event) {
 const nim = document.getElementById("nim");
 const nama = document.getElementById("nama");
 const prodi = document.getElementById("program_studi");
 const email = document.getElementById("email");
 let valid = true;
 document.querySelectorAll(".form-error").forEach(function (el) {
 el.textContent = "";
 });
 document.querySelectorAll(".is-invalid").forEach(function (el) {
 el.classList.remove("is-invalid");
 });
 if (nim.value.trim() === "") {
 document.getElementById("errorNim").textContent = "NIM wajib diisi.";
 nim.classList.add("is-invalid");
 valid = false;
 }
 if (nama.value.trim() === "") {
 document.getElementById("errorNama").textContent = "Nama wajib diisi.";
 nama.classList.add("is-invalid");
 valid = false;
 }
 if (prodi.value.trim() === "") {
 document.getElementById("errorProdi").textContent = "Program studi wajib diisi.";
 prodi.classList.add("is-invalid");
 valid = false;
 }
 if (email.value.trim() === "" || !email.checkValidity()) {
 document.getElementById("errorEmail").textContent = "Email wajib menggunakan format yang valid.";
 email.classList.add("is-invalid");
 valid = false;
 }
 if (!valid) {
 event.preventDefault();
 alert("Form belum valid. Periksa kembali data Anda.");
 }
 });
 }
});
const deleteForms = document.querySelectorAll(".delete-form");
deleteForms.forEach(function (form) {
 form.addEventListener("submit", function (event) {
 const yakin = confirm("Yakin ingin menghapus data ini?");
 if (!yakin) {
 event.preventDefault();
 }
 });
});
const searchInput = document.getElementById("searchMahasiswa");
const tableRows = document.querySelectorAll("#crudTable tbody tr");
if (searchInput) {
 searchInput.addEventListener("input", function () {
 const keyword = searchInput.value.toLowerCase().trim();
 tableRows.forEach(function (row) {
 const text = row.textContent.toLowerCase();
 row.style.display = text.includes(keyword) ? "" : "none";
 });
 });
}
const params = new URLSearchParams(window.location.search);
const status = params.get("status");
if (status === "tambah") {
 alert("Data berhasil ditambahkan.");
}
if (status === "update") {
 alert("Data berhasil diperbarui.");
}
if (status === "hapus") {
 alert("Data berhasil dihapus.");
}
