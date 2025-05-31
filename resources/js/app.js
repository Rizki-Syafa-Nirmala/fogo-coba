import './bootstrap';
import 'flowbite';
import '../css/app.css';

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('profilePicturePreview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}