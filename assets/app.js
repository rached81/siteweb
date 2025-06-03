// assets/app.js

// (vos autres imports Bootstrap, CSS, Stimulus, jQuery, etc. si existants)
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.scss';

// Import du build “Full-Free” CKEditor
import ClassicEditor from './ckeditor-full';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ckeditor').forEach(el => {
        ClassicEditor
            .create(el, {
                licenseKey: 'GPL',                    // Nécessaire pour CKEditor OSS
                ckfinder: {
                    uploadUrl: '/efconnect/default/'    // Voir section 7
                }
            })
            .catch(error => console.error(error));
    });
});
