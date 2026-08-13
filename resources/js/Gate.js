export default class Gate {
    constructor(user) {
        this.user = user;
    }

    hasRole(roles) {
        if (!this.user || !this.user.type) return false;
        if (Array.isArray(roles)) {
            return roles.includes(this.user.type);
        }
        return this.user.type === roles;
    }

    isAdmin() {
        return this.hasRole('admin');
    }

    isUser() {
        return this.hasRole('user');
    }

    isPelayanan() {
        return this.hasRole('pelayanan');
    }

    isKredit() {
        return this.hasRole('kredit');
    }

    isAK() {
        return this.hasRole('akunting');
    }

    isUM() {
        return this.hasRole('umumpst');
    }

    isBisnis() {
        return this.hasRole('bisnis');
    }

    isSekdir() {
        return this.hasRole('sekdir');
    }

    isSkai() {
        return this.hasRole('skai');
    }

    isSdm() {
        return this.hasRole('sdm');
    }

    isPpk() {
        return this.hasRole('ppk');
    }

    isCs() {
        return this.hasRole('cs');
    }

    isAdminOrUser() {
        return !!(this.user && this.user.type);
    }
}


