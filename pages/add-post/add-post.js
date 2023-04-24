function previewImage(input) {
  if (input.files) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var preview = document.createElement("img");
      preview.src = e.target.result;
      preview.width = 450;
      preview.height = 450;

      preview.classList.add("!max-h-[400px]", "border", "border-black");

      // Elemen label untuk "Add Image" box
      var label = input.parentNode;

      // Cek apakah udah ada preview image di elemen label
      var existingPreview = label.querySelector("img");
      if (existingPreview) {
        label.replaceChild(preview, existingPreview);
      } else {
        // Hapus "Add Image" box dari elemen label
        var addImageBox = label.querySelector("span");
        label.removeChild(addImageBox);
        // Add preview image ke elemen label
        label.appendChild(preview);
      }
    };
    // Baca data URL dari file image yang dipilih user
    reader.readAsDataURL(input.files[0]);
  }
}

var textarea = document.getElementById("description");
var charCount = document.getElementById("char-count");

function countCharacters() {
  var text = textarea.value;
  var count = text.length;
  charCount.innerHTML = count + "/1000";
}

function showDescription() {
  var box = document.getElementById("desc-box");
  var description = document.getElementById("description");
  box.classList.add("hidden");
  description.classList.remove("hidden");
}
