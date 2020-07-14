<template>
    <div class="columns-tchat">
        <div class="conversation_list">
            <h5>Liste des conversations</h5>
            <div class="conversation current">
                <div class="preview_conv">
                    <h5>Voyage en Espagne</h5>
                    <p>Vous arrivez d'ici combien de ...</p>
                </div>
                <div class="avatar_conv">
                    <vs-avatar-group max="4">
                        <vs-avatar>
                            <img src="https://cdn.discordapp.com/attachments/387598639532605453/685248718055931907/logo_large.png" alt="">
                        </vs-avatar>
                        <vs-avatar>
                            <img src="https://static.lexpress.fr/medias_12152/w_600,h_600,c_fill,g_north/v1571084618/carre-long-caroline-receveur_6222166.jpg" alt="">
                        </vs-avatar>
                    </vs-avatar-group>
                </div>
            </div>
        </div>

        <div class="conversation_messages">
            <MessagesTchat />
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import MessagesTchat from './MessagesTchat'

    export default {
        name: "ListTchat",
        data: () => ({

        }),
        components: {
            'MessagesTchat' : MessagesTchat
        }
    }
</script>
