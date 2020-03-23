<template>
    <div class="profile">
        <aside class="nav__menu">
            <header>
                <h1>Viamicis</h1>
                <button class="vs-button">
                    <i data-feather="disc"></i>
                </button>
            </header>
            <section>
                <div class="sidenav-link">
                    <router-link
                            :to="{ name: 'dashboard' }"
                            v-bind:class="{ 'sidenav-link-active': currentRoute('dashboard') }"
                    >
                        <i data-feather="home"></i> Dashboard
                    </router-link>
                </div>
                <div>
                    <span class="navigation-header">Voyage</span>
                    <div class="sidenav-link">
                        <router-link
                                :to="{ name: 'addTrip' }"
                                v-bind:class="{ 'sidenav-link-active': currentRoute('addTrip') }"
                        >
                            <i data-feather="plus-square"></i> Proposer un voyage
                        </router-link>
                    </div>
                    <div class="sidenav-link">
                        <a href="#"><i data-feather="compass"></i> Rejoindre un voyage</a>
                    </div>
                    <div class="sidenav-link">
                        <a href="#"><i data-feather="eye"></i> Voir mes voyages</a>
                    </div>
                    <div class="sidenav-link">
                        <a href="#"><i data-feather="star" class="text-gold"></i> Notre sélection</a>
                    </div>
                </div>
                <div>
                    <span class="navigation-header">Blog</span>
                    <div class="sidenav-link">
                        <a href="#"><i data-feather="book-open"></i> Lire un article</a>
                    </div>
                    <div class="sidenav-link">
                        <a href="#"><i data-feather="edit-3"></i> Rédiger un article</a>
                    </div>
                </div>
            </section>
        </aside>
        <aside class="content__box">
            <div class="header__box">
                <header>
                    <div class="header-flex">
                        <div class="header-links">
                            <a href="http://vuesax.com/">
                                <span><i data-feather="home"></i></span>
                            </a>
                            <a href="#" @click="openNotificationUser()">
                                <span><i data-feather="message-square"></i></span>
                            </a>
                            <a href="http://vuesax.com/">
                                <span><i data-feather="calendar"></i></span>
                            </a>
                        </div>
                        <div class="header-account">
                            <div class="header-links-account">
                                <button class="vs-button" @click="showSettings = true">
                                    <i data-feather="settings"></i>
                                </button>
                            </div>
                            <div class="box-identity">
                                <p class="font-semibold">{{ user.firstname }} {{ user.lastname }}</p>
                                <small>Disponible</small>
                            </div>
                            <vs-avatar size="40px" src="https://cdn.discordapp.com/attachments/387598639532605453/685248718055931907/logo_large.png"/>
                        </div>
                    </div>
                </header>
            </div>
            <transition v-bind:name="user.transition" mode="out-in">
                <router-view v-bind:user="user"/>
            </transition>
        </aside>
        <transition name="translate">
            <aside v-show="showSettings" class="settings_box">
                <div class="setting_content">
                    <header>
                        <h2>Mes options</h2>
                        <button class="vs-button" @click="showSettings = false">
                            <i data-feather="x-circle"></i>
                        </button>
                    </header>
                    <section style="padding: 20px">
                        <span class="navigation-header">Couleur de l'application</span>
                        <div class="flex-container">
                            <vs-button
                                    color="#7267f0"
                                    @click="changePrimaryColor('#7267f0')"
                            >
                                <i class='bx bxs-paint-roll' ></i>
                            </vs-button>
                            <vs-button
                                    color="#28c770"
                                    @click="changePrimaryColor('#28c770')"
                            >
                                <i class='bx bxs-paint-roll' ></i>
                            </vs-button>
                            <vs-button
                                    color="#ea5454"
                                    @click="changePrimaryColor('#ea5454')"
                            >
                                <i class='bx bxs-paint-roll' ></i>
                            </vs-button>
                            <vs-button
                                    color="#1e1e1e"
                                    @click="changePrimaryColor('#1e1e1e')"
                            >
                                <i class='bx bxs-paint-roll' ></i>
                            </vs-button>
                            <vs-button
                                    color="#3dc9b4"
                                    @click="changePrimaryColor('#3dc9b4')"
                            >
                                <i class='bx bxs-paint-roll' ></i>
                            </vs-button>
                        </div>
                        <span class="navigation-header">Couleur de l'application</span>
                        <vs-radio v-model="user.transition" vs-name="transition" vs-value="fade">
                            Fondu
                        </vs-radio>
                        <vs-radio v-model="user.transition" vs-name="transition" vs-value="translate">
                            Translation
                        </vs-radio>
                        <vs-radio v-model="user.transition" vs-name="transition" vs-value="zoom">
                            Zoom
                        </vs-radio>
                    </section>
                </div>
            </aside>
        </transition>
    </div>
</template>

<script>
    import user from './Components/User';
    const feather = require('feather-icons');

    export default {
        data:() => ({
            showSettings: false
        }),
        mounted() {
            feather.replace();
            this.$vs.theme({
                primary: this.user.color
            });
        },
        watch:{
            $route (to, from){
                setTimeout(() => { feather.replace() }, 350);
            },
            color() {
                this.$vs.theme({
                    primary: this.user.color
                });
            }
        },
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        computed: {
            color() {
                return this.user.color;
            }
        },
        methods: {
            changePrimaryColor(primaryColor) {
                this.user.color = primaryColor;
            },
            openNotification(position = null, color) {
                const noti = this.$vs.notification({
                    sticky: true,
                    color,
                    position,
                    title: 'Documentation Vuesax 4.0+',
                    text: 'These documents refer to the latest version of vuesax (4.0+), to see the documents of the previous versions you can do it here 👉 Vuesax 3.x'
                })
            },
            openNotificationUser() {
                const noti = this.$vs.notification({
                    duration: 'none',
                    width: 'auto',
                    content: user,
                })
            },

            currentRoute(route) {
                return route === this.$router.currentRoute.name;
            },
        }
    }
</script>
