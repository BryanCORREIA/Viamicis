<template>
    <div>
        <header>
            <h2>
                <router-link
                        :to="{ name: 'dashboard' }"
                >
                    Dashboard
                </router-link>
                /
                <span class="current__breadcrump">Voyage</span>
            </h2>
        </header>
        <div class="separation"></div>
        <div class="content_main">
            <div class="links__action">
                <router-link
                        :to="{ name: 'joinTrip' }"
                        class="card_link w-30"
                >
                    <span class="icon__link"><i class="fal fa-search"></i></span>
                    <span class="text__link">Rechercher un voyage</span>
                </router-link>
                <router-link
                        :to="{ name: 'addTrip' }"
                        class="card_link w-30"
                >
                    <span class="icon__link"><i class="fal fa-plus-circle"></i></span>
                    <span class="text__link">Ajouter un voyage</span>
                </router-link>
                <router-link
                        :to="{ name: 'dashboard' }"
                        class="card_link w-30"
                >
                    <span class="icon__link"><i class="fal fa-eye"></i></span>
                    <span class="text__link">Consulter mes voyages</span>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ActionTrip"
    }
</script>

<style scoped>

</style>
