import $ from 'jquery';
window.jQuery = window.$ = $;

import 'jquery-ui-dist/jquery-ui';
import 'jquery-ui-dist/jquery-ui.css';

// CKEditor 5 (version classique)
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Initialisation CKEditor
document.querySelectorAll('.ckeditor').forEach(el => {
    // Cache le texte brut
    el.style.display = 'none';

    ClassicEditor.create(el, {
        licenseKey: 'GPL',
        language: 'fr',
        ckfinder: {
            uploadUrl: '/efconnect',
            openerMethod: 'popup'
        },
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'link', '|',
            'bulletedList', 'numberedList', '|',
            'blockQuote', 'imageUpload', 'insertTable', '|',
            'undo', 'redo'
        ]
    }).then(editor => {
        console.log('CKEditor prêt');
        el.style.display = 'block';
    }).catch(error => {
        console.error(error);
        el.style.display = 'block'; // Fallback
    });
});
// Remplacez toute la partie elFinder par :
if (document.querySelector('.elfinder')) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/bundles/fmelfinder/css/elfinder.min.css';
    document.head.appendChild(link);

    const script = document.createElement('script');
    script.src = '/bundles/fmelfinder/js/elfinder.min.js';
    script.onload = () => {
        $('.elfinder').elfinder({
            url: '/efconnect?cmd=open',  // Ajout du paramètre cmd
            height: 500,
            handlers: {
                error: (error) => console.error('elFinder error:', error)
            }
        });
    };
    document.body.appendChild(script);
}
