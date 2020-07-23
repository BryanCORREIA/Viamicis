<template>
    <main>
        <div class="container-article">
            <div class="401" v-if="article.valide <= 0 && !isAdmin">
                <div class="not-log">
                    <div class="gif-401">
                        <img src="/res/403.gif" alt="">
                    </div>
                    <div class="error-401">
                        <p style="text-align: center">Vous n'êtes pas autorisé à lire cet article. <br> Contactez un administrateur du site si vous pensez que c'est une erreur.</p>
                        <vs-button flat circle class="btn-center" :to="{ name: 'list' }">Retour</vs-button>
                    </div>
                </div>
            </div>
            <div class="post" v-else>
                <span class="main-cat">Guide</span>
                <h3 class="title-article">{{ this.article.title }}</h3>
                <p class="creator">{{ this.article.creator.firstname }} {{ this.article.creator.lastname }}</p>
                <p class="created-at">{{ this.article.createdAt }}</p>
                <div v-if="isAdmin && article.valide === -1" class="action-admin">
                    <vs-alert :hidden-content.sync="hidden" danger>
                        <template #title>
                            Action d'administration
                        </template>
                        <div class="content-alert">
                            <p>Souhaitez-vous valider et rendre publique cet article ?</p>
                            <vs-button
                                    danger
                                    flat
                                    class="btn-admin"
                            >
                                Refuser <i class="fad fa-times"></i>
                            </vs-button>
                            <vs-button
                                    success
                                    flat
                                     class="btn-admin"
                            >
                                Valider <i class="fad fa-check"></i>
                            </vs-button>
                        </div>
                    </vs-alert>
                </div>
                <img :src="'/res/blog/' + this.article.illustration" alt="" class="article-illus">
                <p v-html="this.article.content"></p>
            </div>
        </div>
    </main>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Article",
        data: () => ({
            isAdmin: 0,
            article: '',
            hidden: true,
            deleteTooltip: false,
        }),
        created() {
            axios
                .get(`/blog/article/${this.$route.params.slug}`)
                .then(response => {
                    this.article = JSON.parse(response.data);
                })
            ;
        },
        mounted() {
            axios
                .get('/check-user/admin')
                .then(response => {
                    if (response.data === 'true') {
                        this.isAdmin = 1;
                    }
                })
            ;
        },
        methods: {
        }
    }
</script>
