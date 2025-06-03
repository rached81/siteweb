// assets/app.js

// (vos autres imports, par ex. Bootstrap / CSS / Stimulus, etc.)
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.scss'; // si vous avez un dossier styles/

// … vos initialisations existantes (jQuery, Stimulus, etc.) …

// Import du build Full de CKEditor (depuis assets/ckeditor-full.js)
import ClassicEditor from './ckeditor-full';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ckeditor').forEach(el => {
        ClassicEditor
            .create(el, {
                licenseKey: 'GPL',               // Indispensable en mode open source
                ckfinder: {
                    uploadUrl: '/efconnect/default/' // Connecteur elFinder
                }
            })
            .catch(error => console.error(error));
    });
});
