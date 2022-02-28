export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'user';
    }

    isPelayanan(){
        return this.user.type === 'pelayanan';
    }
    isKredit(){
        return this.user.type === 'kredit';
    }
    isAK(){
        return this.user.type === 'akunting';
    }
    isUM(){
        return this.user.type === 'umumpst';
    }
    isSekdir(){
        return this.user.type === 'sekdir';
    }
    isSkai(){
        return this.user.type === 'skai';
    }
    isSdm(){
        return this.user.type === 'sdm';
    }
    
    isAdminOrUser(){
        if(this.user.type === 'sdm' || this.user.type === 'skai' || this.user.type === 'sekdir' || this.user.type === 'umumpst' || this.user.type === 'akunting' || this.user.type === 'kredit' || this.user.type === 'pelayanan' || this.user.type === 'user' || this.user.type === 'admin'){
            return true;
        }
    }
}

