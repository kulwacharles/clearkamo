class CKEditorManager {
    constructor() {
        this.editors = new Map();
        this.currentModalType = null;
    }

    // Initialize CKEditor for a specific modal type
    initEditor(modalType, editorId, component, initialContent = '') {
        const editorElement = document.getElementById(editorId);
        
        if (!editorElement || typeof ClassicEditor === 'undefined') {
            console.warn('CKEditor not available for:', editorId);
            return;
        }

        // Destroy existing editor if any
        this.destroyEditor(editorId);

        ClassicEditor
            .create(editorElement, {
                toolbar: {
                    items: [
                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 
                        'numberedList', '|', 'outdent', 'indent', '|', 'imageUpload',
                        'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                    ]
                },
                language: 'en'
            })
            .then(editor => {
                this.editors.set(editorId, editor);
                
                // Set initial content
                if (initialContent) {
                    editor.setData(initialContent);
                }

                // Listen for changes
                editor.model.document.on('change:data', () => {
                    if (component) {
                        component.set('description', editor.getData());
                    }
                });

                console.log('CKEditor initialized for:', editorId);
            })
            .catch(error => {
                console.error('Failed to initialize CKEditor:', error);
            });
    }

    // Destroy specific editor
    destroyEditor(editorId) {
        const editor = this.editors.get(editorId);
        if (editor) {
            editor.destroy().catch(error => {
                console.error('Error destroying editor:', error);
            });
            this.editors.delete(editorId);
        }
    }

    // Destroy all editors
    destroyAll() {
        this.editors.forEach((editor, editorId) => {
            this.destroyEditor(editorId);
        });
        this.editors.clear();
    }

    // Set editor content
    setContent(editorId, content) {
        const editor = this.editors.get(editorId);
        if (editor) {
            editor.setData(content || '');
        }
    }

    // Clear editor content
    clearEditor(editorId) {
        this.setContent(editorId, '');
    }
}

// Global instance
window.ckEditorManager = new CKEditorManager();