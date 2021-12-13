<template>
    <div>
        <div class="textblock-editor" :id="_uid">
            <slot></slot>
        </div>

        <div class="save-button button button--success" @click="save">
            <i class="fa fa-save" style="margin-right: 16px"></i> {{ saveButtonText }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            resource: {
                type: String,
                required: true
            },
            resourceId: {
                required: true
            },
        },

        data() {
            return {
                editor: null,
                saveButtonText: this.__("Сохранить"),
            }
        },

        mounted() {
            this.editor = $("#" + this._uid).froalaEditor({
                language: 'ru',
                requestHeaders: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                },
                toolbarButtons: [
                    'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|',
                    'quote', '|', // 'paragraphStyle', 'fontSize', 'color',
                    'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent',
                    '-',
                    'insertLink', 'insertImage', 'insertVideo', 'embedly', 'insertTable', '|',
                    'specialCharacters', 'insertHR', 'clearFormatting', '|',
                    'print', 'spellChecker', 'help', 'html', '|',
                    'undo', 'redo'
                ],
                fileUpload: false,
                videoUpload: false,
                pastePlain: true,
                toolbarInline: true,
                charCounterCount: false,
                imageUploadURL: '/admin/api/field/editor-field/image/' + this.resource + '/' + this.resourceId,
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'svg', 'gif'],
                imageMaxSize: 1024 * 1024 * 2,
                imageInsertButtons: ['imageBack', '|', 'imageUpload', 'imageByURL'],
                entities: '&quot;&#39;&iexcl;&cent;&pound;&curren;&yen;&brvbar;',
                imageStyles: {
                    'img-bordered': 'С рамкой',
                },
                blockStyles: {
                    // 'responsive-table': 'Мобильная таблица',
                },
                // tableStyles: {
                //     // 'responsive-table': 'Мобильная таблица',
                // },
                paragraphStyles: {
                    //
                },
            }).on('froalaEditor.image.error', function (e, editor, error, response) {
                if (response !== undefined)
                    console.log(response);
            });
        },

        methods: {
            save() {
                let value = this.editor.froalaEditor('html.get')

                if (! value && ! confirm("Сохранится пустое значение. Продолжить?"))
                    return;

                let self = this

                this.axios.request({
                    method: 'POST',
                    url: '/api/save/' + this.resource + '/' + this.resourceId,
                    data: { value }
                }).then(() => {
                    self.saveButtonText = this.__("Данные сохранены")
                    self.textChanged = false

                    setTimeout(() => {
                        self.saveButtonText = this.__("Сохранить")
                    }, 2000)
                }).catch((error) => {
                    alert(this.__("Произошла ошибка"))
                    console.log(error)
                })
            },
        }
    }
</script>

<style lang="scss" scoped>
    .save-button {
        position: fixed;
        bottom: 32px;
        right: 32px;
        z-index: 2;
    }
</style>