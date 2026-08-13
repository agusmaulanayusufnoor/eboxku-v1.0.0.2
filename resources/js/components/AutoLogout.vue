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

        watch: {
            $route(to, from) {
                if (to && to.path === '/kepuasancs') {
                    this.resetTimers();
                } else {
                    this.resetTimer();
                }
            }
        },

        methods: {
            isKioskMode: function () {
                return (this.$route && this.$route.path === '/kepuasancs');
            },

            setTimers: function () {
                if (this.isKioskMode()) {
                    this.resetTimers();
                    return;
                }

                this.warningTimer = setTimeout(this.warningMessage, 12 * 60 * 1000); // 12 menit
                this.logoutTimer = setTimeout(this.logoutUser, 15 * 60 * 1000); // 15 menit

                this.warningZone = false;
            },

            warningMessage: function () {
                if (this.isKioskMode()) return;
                this.warningZone = true;
            },

            logoutUser: function () {
                if (this.isKioskMode()) return;
                const logoutForm = document.getElementById('logout-form');
                if (logoutForm) {
                    logoutForm.submit();
                }
            },

            resetTimers: function () {
                clearTimeout(this.warningTimer);
                clearTimeout(this.logoutTimer);
                this.warningTimer = null;
                this.logoutTimer = null;
                this.warningZone = false;
            },

            resetTimer: function () {
                if (this.isKioskMode()) {
                    this.resetTimers();
                    return;
                }

                this.resetTimers();
                this.setTimers();
            }
        }
    }
</script>
