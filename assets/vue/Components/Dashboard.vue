<template>
    <div>
        <h2 class="profile-title">Dashboard</h2>
        <vs-row>
            <vs-col vs-w="6">
                <div class="profile-card text-center bg-primary-gradient dark-card">
                    <img src="../../../public/res/decore-left.png" alt="" class="decore-left">
                    <img src="../../../public/res/decore-right.png" alt="" class="decore-right">
                    <span class="box-icon shadow bg-primary">
                            <i data-feather="calendar"></i>
                        </span>
                    <h1 class="font-lighter title-welcome">Bienvenue {{ user.firstname }}</h1>
                    <p class="mb-0">Bienvenue sur votre espace <b>Viamicis</b>, trouvez des compagnons de voyage et allez explorez le monde.</p>
                </div>
                {{ user }}
            </vs-col>
        </vs-row>
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
