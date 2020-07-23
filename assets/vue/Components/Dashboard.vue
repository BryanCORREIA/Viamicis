<template>
    <div>
        <header>
            <h2><span class="current__breadcrump">Tableau de bord</span></h2>
        </header>
        <div class="separation"></div>
        <div class="content_main">
            <div class="links__action">
                <router-link
                        :to="{ name: 'actionTrip' }"
                        class="card_link w-30"
                >
                    <img src="/res/fly.gif" alt="">
                    <span class="text__link">Voyager</span>
                </router-link>
                <router-link
                        :to="{ name: 'listTchat' }"
                        class="card_link w-30"
                >
                    <img src="/res/message.gif" alt="">
                    <span class="text__link">Messagerie</span>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Dashboard',
        props: {
            user: Object
        }
    }
</script>
