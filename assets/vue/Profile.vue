<template>
    <div class="profile__box" v-if="this.loaded">
        <header>
            <div class="header__logo">
                <img src="/res/logo-white.svg" alt="">
            </div>
            <div class="header__content">
                <h1>Viamicis</h1>
                <router-link
                        :to="{ name: 'addTrip' }"
                        class="new__trip"
                        v-bind:class="{ 'sidenav-link-active': currentRoute('addTrip') }"
                >
                    Proposer un voyage
                </router-link>
            </div>
            <div class="header__aside">
                <vs-tooltip bottom>
                    <a>
                        <i class="fas fa-bug"></i>
                    </a>
                    <template #tooltip>
                        Un problème ? Signalez le ici.
                    </template>
                </vs-tooltip>
                <vs-tooltip bottom>
                    <a
                        :class="userInfo ? 'active' : ''"
                        @click="userInfo = !userInfo"
                    >
                        <i class="fal fa-user"></i>
                    </a>
                    <template #tooltip>
                        Information utilisateur
                    </template>
                </vs-tooltip>
                <vs-tooltip bottom>
                    <a
                        @click="active=!active">
                        <i class="fal fa-cog"></i>
                    </a>
                    <template #tooltip>
                        Paramètres
                    </template>
                </vs-tooltip>
            </div>
        </header>
        <div class="content__box">
            <nav>
                <div class="nav__top">
                    <vs-tooltip right>
                        <router-link
                                :to="{ name: 'dashboard' }"
                                v-bind:class="{ 'sidenav-link-active': currentRoute('dashboard') }"
                        >
                            <i class="fal fa-home-lg-alt"></i>
                        </router-link>
                        <template #tooltip>
                            Dashboard
                        </template>
                    </vs-tooltip>
                    <vs-tooltip right>
                        <router-link
                                :to="{ name: 'actionTrip' }"
                                v-bind:class="{ 'sidenav-link-active': currentRoute('addTrip') }"
                        >
                            <i class="fal fa-plane-departure"></i>
                        </router-link>
                        <template #tooltip>
                            Voyage
                        </template>
                    </vs-tooltip>
                    <a href="#"><i class="fal fa-comments-alt"></i></a>
                    <a href="#"><i class="fal fa-book-open"></i></a>
                </div>
                <div class="nav__bottom">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <vs-dialog blur width="550px" not-center v-model="active">
                        <template #header>
                            <h4 class="not-margin">
                                Paramétre de l'interface
                            </h4>
                        </template>

                        <div class="con-content">
                            <p>Couleur de l'intercace</p>
                            <div :style="`background: ${user.color};`" class="con-input">
                                <input v-model="user.color" type="color">
                                <i class='bx bxs-color-fill'></i>
                            </div>
                        </div>

                        <template #footer>
                            <div class="con-footer">
                                <vs-button @click="active=false" transparent>
                                    Terminé
                                </vs-button>
                            </div>
                        </template>
                    </vs-dialog>
                </div>
            </nav>
            <main :class="userInfo ? 'aside__open' : ''">
                <transition v-bind:name="user.transition" mode="out-in">
                    <router-view v-bind:user="this.user"/>
                </transition>
            </main>
            <transition name="translate__user__info">
                <aside v-show="userInfo">
                    <div class="user__info">
                        <p>Bonjour, <br><b>{{ this.user.firstname }}</b></p>
                        <vs-avatar size="70">
                            <img :src="this.user.picture" alt="">
                        </vs-avatar>
                    </div>

                    <div class="user__stats">
                        <div class="stat">
                            <p>Voyages</p>
                            <div class="number__stat border-purple">
                                <span>10</span>
                            </div>
                        </div>
                        <div class="stat">
                            <p>Messages</p>
                            <div class="number__stat border-yellow">
                                <span>178</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </transition>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Profile",
        data: () => ({
            user : Object,
            active: false,
            userInfo: true,
            loaded: false
        }),
        watch: {
            'user.color': function () {
                this.$vs.setColor('primary', this.user.color);
            }
        },
        created() {
            const loading = this.$vs.loading({
                type : 'gradient',
                color : this.user.color,
                opacity : 1

            });

            axios
                .get('/utilisateur')
                .then((response) => {
                    this.user = JSON.parse(response.data);
                    this.$vs.setColor('primary', this.user.color);
                    this.loaded = true;
                    loading.close();
                })
                .catch((response) => {
                    console.log(response)
                })
            ;
        },
        mounted() {

        },
        methods: {
            currentRoute(route) {
                return route === this.$router.currentRoute.name;
            },
            changePrimary() {
                this.$vs.setColor('primary', this.user.color);
            }
        }
    }
</script>
