<template>
    <main>
        <div class="container" ref="mainList">
            <h2 class="title-section"><i class="fad fa-folder-open folder-icon"></i> Nos articles</h2>
            <div class="all-section">
                <div class="sub-post">
                    <div class="post" v-for="article in articles">
                        <div class="illustration-post" :style="{'background-image': 'url(\'/res/blog/' + article.illustration + '\')'}"></div>
                        <div class="info-post">
                            <div class="top">
                                <span class="label-cat">Guide</span>
                                <p class="title-sub-post">{{ article.title }} <i class="fad fa-badge-check success-icon" v-if="article.valide === 1"></i></p>
                                <p class="beginning-text">{{ article.content | truncate(300, '...') }}</p>
                            </div>
                            <div class="bottom">
                                <vs-button flat class="button-read-more" :to="{ name: 'article', params: { slug: article.slug } }">
                                    Lire l'article
                                </vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter-section" v-if="!loading">
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

    export default {
        name: "Home",
        data: () => ({
            articles: '',
            loading: true
        }),
        mounted() {
            axios
                .get('/blog/articles')
                .then(response => {
                    this.articles = JSON.parse(response.data);

                    this.loading = false;
                })
            ;
        }
    }
</script>
