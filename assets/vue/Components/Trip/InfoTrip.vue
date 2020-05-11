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
                <router-link
                        :to="{ name: 'actionTrip' }"
                >
                    Voyage
                </router-link>
                /
                <router-link
                        :to="{ name: 'joinTrip' }"
                >
                    Rejoindre un voyage
                </router-link>
                /
                <span class="current__breadcrump">{{ trip.title }}</span>
            </h2>
        </header>
        <div class="separation"></div>
        <div class="content_main">
            <div class="columns_trip">
                <div class="main_info">
                    <vs-alert :hidden-content.sync="infoTripHidden">
                        <template #title>
                            En quelques mots
                        </template>
                        {{ trip.title }}
                    </vs-alert>

                    <div class="description_trip">
                        {{ trip.description }}
                    </div>
                </div>
                <div class="right_info">
                    <div class="creator_info">
                        <vs-avatar class="avatar_info">
                            <img :src="trip.creatorPic" alt="">
                        </vs-avatar>
                        <div class="info_crea">
                            {{ trip.creator }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "InfoTrip",
        data: () => ({
            trip : '',
            infoTripHidden: false
        }),
        mounted() {
            axios
                .get(`/api/get-trip/${this.$route.params.id}`)
                .then(response => {
                    this.trip = JSON.parse(response.data);
                })
            ;
        },
        methods: {

        }
    }
</script>
