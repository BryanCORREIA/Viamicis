<template>
    <div class="center examplex">
        <vs-navbar fixed center-collapsed padding-scroll shadow-scroll v-model="active" class="header-nav">
            <template #left>
                <a href="/">
                    <img src="/res/logo.png" alt="" class="header-logo">
                </a>
                <a href="/">
                    <h1>Viamicis</h1>
                </a>
            </template>
            <vs-navbar-item :active="this.$router.currentRoute.name === 'home'" id="home" :to="{ name: 'home' }">
                Accueil
            </vs-navbar-item>
            <vs-navbar-item :active="this.$router.currentRoute.name === 'list'" id="browse" :to="{ name: 'list' }">
                Parcourir
            </vs-navbar-item>
            <vs-navbar-item :active="this.$router.currentRoute.name === 'add'" id="license" :to="{ name: 'add' }">
                Rédiger un article
            </vs-navbar-item>
            <template #right>
                <vs-button flat href="/profil">Mon compte</vs-button>
            </template>
        </vs-navbar>

        <transition name="fade" mode="out-in">
            <router-view />
        </transition>
    </div>
</template>

<script>
    export default {
        name: "Blog",
        data:() => ({
        }),
        mounted() {
        }
    }
</script>
