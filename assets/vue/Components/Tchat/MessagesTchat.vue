<template>
    <div class="tchatbox">
        <div class="header_box">
            <h5>Voyage en Espagne</h5>
            <div class="header_avatar">
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
        <div class="content_box" id="messageBody">
            <div class="begin_conv">
                <vs-avatar-group max="4">
                    <vs-avatar>
                        <img src="https://cdn.discordapp.com/attachments/387598639532605453/685248718055931907/logo_large.png" alt="">
                    </vs-avatar>
                    <vs-avatar>
                        <img src="https://static.lexpress.fr/medias_12152/w_600,h_600,c_fill,g_north/v1571084618/carre-long-caroline-receveur_6222166.jpg" alt="">
                    </vs-avatar>
                </vs-avatar-group>
                <h5 style="text-align: center">Bienvenue sur la conversation de votre voyage !</h5>
            </div>
            <div class="text_send">
                <p>Salut tout le monde !</p>
            </div>
            <div class="text_received">
                <vs-avatar size="35">
                    <img src="https://static.lexpress.fr/medias_12152/w_600,h_600,c_fill,g_north/v1571084618/carre-long-caroline-receveur_6222166.jpg" alt="">
                </vs-avatar>
                <p>Salut Bryan, bienvenue ! <br> Pense à te présenter !</p>
            </div>
        </div>
        <div class="insert_tchat">
            <input type="text" placeholder="Écrivez un message">
            <vs-button class="send_button">
                Envoyer
                <template #animate >
                    <i class="fab fa-telegram-plane"></i>
                </template>
            </vs-button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "ListTchat",
        data: () => ({

        }),
        mounted() {
            const messageBody = document.querySelector('#messageBody');
            messageBody.scrollTop = messageBody.scrollHeight;
        },
        updated() {
            const messageBody = document.querySelector('#messageBody');
            messageBody.scrollTop = messageBody.scrollHeight;
        },
    }
</script>
