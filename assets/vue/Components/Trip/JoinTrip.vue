<template>
    <div>
        <header>
            <h2>
                <router-link
                        :to="{ name: 'dashboard' }"
                >
                    Tableau de bord
                </router-link>
                /
                <router-link
                        :to="{ name: 'actionTrip' }"
                >
                    Voyage
                </router-link>
                /
                <span class="current__breadcrump">Rejoindre un voyage</span>
            </h2>
        </header>
        <div class="separation"></div>
        <div class="content_main">
            <div class="all_trips">
                <div
                        v-for="trip in trips"
                        class="one_trip"
                >
                    <vs-avatar size="80" class="flag_avatar">
                        <img v-bind:src="trip.flag" alt="">
                    </vs-avatar>
                    <div class="trip_info">
                        <h3>{{ trip.title }}</h3>
                        <p>Pendant <b>{{ trip.days }}</b> jours <br> À partir du <b>{{ trip.date }}</b></p>
                        <div class="creator-info">
                            <p>{{ trip.creator }}</p>
                        </div>
                    </div>
                    <vs-button
                        class="know_more_trip"
                        :to="{ name: 'infoTrip', params: { id: trip.id } }"
                    >
                        En savoir plus
                    </vs-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "JoinTrip",
        data: () => ({
            trips : [],
        }),
        mounted() {
            axios
                .get('/api/get-all-trip')
                .then(response => {
                    this.loadFlags(JSON.parse(response.data))
                        .then((r) => {
                            console.log(r);
                            this.trips = r;
                        })
                    ;
                })
            ;
        },
        methods: {
            async loadFlags(trips) {
                for (let el of trips) {
                    let countryDetailled = '';

                    await axios
                        .get(`https://restcountries.eu/rest/v2/name/${el.country}`)
                        .then((response) => {
                            countryDetailled = response.data[0];
                        })
                    ;

                    el.flag = countryDetailled.flag;
                }

                return trips;
            }
        }
    }
</script>
