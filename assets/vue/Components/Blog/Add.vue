<template>
    <main>
        <div class="container">
            <h2 class="title-section"><i class="fad fa-pen-alt pen-icon"></i> Rédiger un article</h2>

            <div v-if="this.isLog === 1">
                <div class="input-title">
                    <vs-input
                            placeholder="Titre de votre article"
                            v-model="article.title"
                            class="input-title-in"
                            shadow
                    />
                </div>
                <ckeditor :editor="editor" v-model="article.content" :config="editorConfig"></ckeditor>
                <vs-button flat block style="margin: 10px 0 0 0" @click="submitAdd()">Envoyer</vs-button>
            </div>

            <div v-if="this.isLog === 0">
                <div class="not-log">
                    <div class="gif-401">
                        <img src="/res/401.gif" alt="">
                    </div>
                    <div class="error-401">
                        <p>Vous devez être connecté à votre comptre pour pouvoir rédiger un article</p>
                        <vs-button flat circle class="btn-center" href="/connexion?_target_path=/blog/#/rediger">Me connecter</vs-button>
                    </div>
                </div>
            </div>

            <div class="newsletter-section" v-if="this.isLog !== -1">
                <div class="title-news">
                    <h3>Vous souhaitez être informé de la sortie des nouveaux articles ?</h3>
                </div>
                <div class="input-section">
                    <vs-input
                            shadow
                            primary
                            type="email"
                            icon-after
                            @click-icon="true"
                            placeholder="Email"
                            class="text-input"
                    >
                        <template #icon>
                            <i class="fad fa-paper-plane"></i>
                        </template>
                    </vs-input>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import axios from 'axios';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import('@ckeditor/ckeditor5-build-classic/build/translations/fr.js');

    export default {
        name: "Add",
        components: {
            ckeditor: CKEditor.component
        },
        data: () => ({
            editor: ClassicEditor,
            editorConfig: {
                language: 'fr',
                placeholder: 'Ici débute votre rédaction !',
            },
            isLog: -1,
            article: {
                title: '',
                content: ''
            }
        }),
        mounted() {
            axios
                .get('/check-user')
                .then(response => {
                    if (response.data === 'true') {
                        this.isLog = 1;
                    } else {
                        this.isLog = 0;
                    }
                })
            ;
        },
        methods: {
            submitAdd() {
                const loading = this.$vs.loading({
                    type : 'corners'
                });

                let bodyFormData = new FormData();
                bodyFormData.set('title', this.article.title);
                bodyFormData.set('content', this.article.content);

                axios
                ({
                    method: 'post',
                    url: '/blog/add',
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                    .then(response => {
                        this.wishTrip = false;
                        const noti = this.$vs.notification({
                            sticky: true,
                            color: 'success',
                            position: 'top-left',
                            duration: 6000,
                            title: 'Création de votre article',
                            text: 'Votre article a bien été créé et est en cours de validation par notre équipe !'
                        });

                        loading.close()
                    })
                ;
            }
        }
    }
</script>
