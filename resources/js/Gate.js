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
    
    isAdminOrUser(){
        if(this.user.type === 'kredit' || this.user.type === 'pelayanan' || this.user.type === 'user' || this.user.type === 'admin'){
            return true;
        }
    }
}

