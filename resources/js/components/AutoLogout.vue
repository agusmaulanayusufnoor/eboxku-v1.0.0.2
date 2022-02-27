<template>
    <div v-if="warningZone">Masih bekerja dengan E-Box?</div>
</template>

<script>
    export default {
        name: "AutoLogout",

        data: function () {
            return {
                events: ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],

                warningTimer: null,
                logoutTimer: null,
                warningZone: false
            
            }
        },

        mounted() {
            this.events.forEach(function (event) {
                window.addEventListener(event, this.resetTimer);
            }, this);

            this.setTimers();
        },

        destroyed() {
             this.events.forEach(function (event) {
                window.removeEventListener(event, this.resetTimer);
            }, this);

            this.resetTimers();
        },

        methods: {
            setTimers: function () {
                this.warningTimer = setTimeout(this.warningMessage, 8 * 60 * 1000); // 4 detik (x 60 jika ingin ke menit)
                this.logoutTimer = setTimeout(this.logoutUser, 10 * 60 * 1000); // 4 detik (x 60 jika ingin ke menit)
            
                this.warningZone = false;
            },

            warningMessage: function () {
                this.warningZone = true;
            },

            logoutUser: function () {
                document.getElementById('logout-form').submit();
            },

            resetTimer: function () {
                clearTimeout(this.warningTimer);
                clearTimeout(this.logoutTimer);

                this.setTimers();
            }
        }
    }
</script>
