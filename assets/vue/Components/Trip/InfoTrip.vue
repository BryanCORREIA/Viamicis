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
                        <p>À partir du <b>{{ trip.date }}</b> pendant <b>{{ trip.days }}</b> jours.<br>
                        Pays de voyage : <b>{{ trip.country }}</b><br>
                        Nombre de personnes recherchées : <b>{{ trip.travelers }}</b></p>
                    </vs-alert>

                    <div class="description_trip">
                        <h3>Description du voyage</h3>
                        {{ trip.description }}
                    </div>
                </div>
                <div class="right_info">
                    <div class="creator_info">
                        <div class="creator_avatar">
                            <vs-avatar class="avatar_info">
                                <img :src="trip.creatorPic" alt="">
                            </vs-avatar>
                            <div class="info_crea">
                                <b>{{ trip.creator }}</b>
                            </div>
                        </div>
                        <div class="creator_info_line">
                            <div class="info_line_icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <p>{{ trip.creatorAge }} ans</p>
                        </div>
                        <div class="creator_info_line">
                            <div class="info_line_icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <p>{{ trip.creatorLoc }}</p>
                        </div>
                        <div class="creator_info_line">
                            <div class="info_line_icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <p>{{ trip.creatorPhone }}</p>
                        </div>
                    </div>
                    <div class="particants_list">
                        <h5>Liste des participants</h5>
                        <div class="group_info">
                            <vs-avatar-group class="justify-content-left">
                                <div v-for="participant in trip.participants">
                                    <vs-avatar>
                                        <img :src="participant.userPic" alt="">
                                    </vs-avatar>
                                </div>
                            </vs-avatar-group>
                            <p>{{ (trip.travelers - trip.participants.length) > 1 ? (trip.travelers - trip.participants.length) + ' places restantes' : (trip.travelers - trip.participants.length) + ' place restante' }} </p>
                        </div>
                    </div>
                    <div class="join-trip">
                        <vs-button v-if="trip.alreadyAsk" disabled>Votre demande a été prise en compte</vs-button>
                        <vs-button v-if="!trip.isCreator && !trip.alreadyAsk" @click="joinTrip=!joinTrip">Rejoindre ce voyage</vs-button>
                        <vs-button v-if="trip.isCreator" @click="wishTrip=!wishTrip">{{ trip.wishes.length }} {{ trip.wishes.length > 1 ? 'demandes' : 'demande' }} en attente</vs-button>
                    </div>
                </div>
                <vs-dialog width="550px" not-center v-model="joinTrip">
                    <template #header>
                        <h4 class="not-margin">
                            {{ trip.title }}
                        </h4>
                    </template>

                    <div class="con-content">
                        <p>
                            Souhaitez-vous rejoindre ce voyage ?
                        </p>
                    </div>

                    <template #footer>
                        <div class="con-footer">
                            <vs-button @click="joinTrip=false" dark transparent>
                                Fermer
                            </vs-button>
                            <vs-button @click="wantTrip()" transparent>
                                Rejoindre
                            </vs-button>
                        </div>
                    </template>
                </vs-dialog>

                <vs-dialog width="550px" not-center v-model="wishTrip">
                    <template #header>
                        <h4 class="not-margin">
                            {{ trip.title }} - Demandes en attente
                        </h4>
                    </template>

                    <div class="con-content">
                       <div class="list-wish">
                           <div class="wish" v-for="wish in trip.wishes">
                               <vs-avatar size="120" class="avatar-centered">
                                   <img :src="wish.userPic" alt="">
                               </vs-avatar>
                               <p>{{ wish.userFull }}</p>

                               <div class="wish-buttons">
                                   <vs-button danger class="ans-no" @click="unacceptUser(wish.userId)">Refuser</vs-button>
                                   <vs-button success class="ans-yes" @click="acceptUser(wish.userId)">Accepter</vs-button>
                               </div>
                           </div>
                       </div>
                    </div>

                    <template #footer>
                        <div class="con-footer">
                            <vs-button @click="wishTrip=false" shadow>
                                Fermer
                            </vs-button>
                        </div>
                    </template>
                </vs-dialog>
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
            infoTripHidden: true,
            joinTrip: false,
            wishTrip: false
        }),
        mounted() {
            this.reloadTrip();
        },
        methods: {
            reloadTrip() {
                axios
                    .get(`/api/get-trip/${this.$route.params.id}`)
                    .then(response => {
                        this.trip = JSON.parse(response.data);
                    })
                ;
            },
            wantTrip() {
                let bodyFormData = new FormData();
                bodyFormData.set('trip', this.trip.id);

                axios
                ({
                    method: 'post',
                    url: '/api/want-trip',
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                    .then(response => {
                        this.joinTrip = false;
                        const noti = this.$vs.notification({
                            sticky: true,
                            color: 'success',
                            position: 'top-left',
                            duration: 6000,
                            title: this.trip.title,
                            text: 'Votre demande pour rejoindre ce voyage a bien été enregistrée et envoyée au créateur de ce-dernier.'
                        });
                        this.reloadTrip();
                    })
                ;
            },
            acceptUser(id) {
                let bodyFormData = new FormData();
                bodyFormData.set('trip', this.trip.id);
                bodyFormData.set('user', id);
                bodyFormData.set('accepted', '1');

                axios
                ({
                    method: 'post',
                    url: '/api/trip/wish',
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                    .then(response => {
                        this.wishTrip = false;
                        const noti = this.$vs.notification({
                            sticky: true,
                            color: 'success',
                            position: 'top-left',
                            duration: 6000,
                            title: this.trip.title,
                            text: 'Le profil a bien été accepté.'
                        });
                        this.reloadTrip();
                    })
                ;
            },

            unacceptUser(id) {
                let bodyFormData = new FormData();
                bodyFormData.set('trip', this.trip.id);
                bodyFormData.set('user', id);
                bodyFormData.set('accepted', '0');

                axios
                ({
                    method: 'post',
                    url: '/api/trip/wish',
                    data: bodyFormData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                    .then(response => {
                        this.wishTrip = false;
                        const noti = this.$vs.notification({
                            sticky: true,
                            color: 'danger',
                            position: 'top-left',
                            duration: 6000,
                            title: this.trip.title,
                            text: 'Le profil a bien été refusé.'
                        });
                        this.reloadTrip();
                    })
                ;
            }
        }
    }
</script>
