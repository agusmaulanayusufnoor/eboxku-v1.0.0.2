<template>
    <div v-if="warningZone"><h4>Masih bekerja dengan E-Box?</h4></div>
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
                this.warningTimer = setTimeout(this.warningMessage, 12 * 60 * 1000); // 4 detik (x 60 jika ingin ke menit)
                this.logoutTimer = setTimeout(this.logoutUser, 15 * 60 * 1000); // 4 detik (x 60 jika ingin ke menit)

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
