<template>
    <main>
        <div class="container">
            <h2 class="title-section"><i class="fas fa-heart heart-icon"></i> Nos coups de cœur</h2>
            <div class="heart-section">
                <div class="main-post">
                    <img :src="'/res/blog/' + this.articles[0].illustration" alt="">
                    <span class="label-cat">Guide</span>
                    <p class="title-main-post">{{ this.articles[0].title }} <i class="fad fa-badge-check success-icon" v-if="this.articles[0].valide === 1"></i></p>
                    <p class="beginning-text">{{ this.articles[0].content | truncate(500, '...') }}</p>
                    <vs-button
                            gradient
                            style="min-width: 130px; margin: 0"
                            primary
                            animation-type="scale"
                            class="read-more"
                            :to="{ name: 'article', params: {slug: this.articles[0].slug } }"
                    >
                        <i class="fad fa-book-reader"></i>
                        <template #animate >
                            Lire l'article
                        </template>
                    </vs-button>
                </div>
                <div class="sub-post">
                    <div class="post" v-for="article in articles.slice(0, 4)">
                        <div class="illustration-post" :style="{'background-image': 'url(\'/res/blog/' + article.illustration + '\')'}"></div>
                        <div class="info-post">
                            <div class="top">
                                <span class="label-cat">Guide</span>
                                <p class="title-sub-post">{{ article.title }} <i class="fad fa-badge-check success-icon" v-if="article.valide === 1"></i></p>
                            </div>
                            <div class="bottom">
                                <vs-button flat class="button-read-more" :to="{ name: 'article', params: {slug: article.slug } }">
                                    Lire l'article
                                </vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="title-section"><i class="fad fa-sparkles sparkles-icon"></i> Nouveaux articles</h2>
            <div class="new-section">
                <div class="new-posts">
                    <div class="new-post" v-for="article in articles.slice(0, 3)">
                        <div class="illustration-post" :style="{'background-image': 'url(\'/res/blog/' + article.illustration + '\')'}"></div>
                        <div class="info-post">
                            <div class="top">
                                <span class="label-cat">Guide</span>
                                <p class="title-sub-post">{{ article.title }} <i class="fad fa-badge-check success-icon" v-if="article.valide === 1"></i></p>
                            </div>
                            <div class="bottom">
                                <vs-button flat class="button-read-more" :to="{ name: 'article', params: {slug: article.slug } }">
                                    Lire l'article
                                </vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter-section">
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
    import axios from "axios";

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
