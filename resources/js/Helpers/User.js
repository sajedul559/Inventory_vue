import Token from './Token'
import AppStorage from './AppStorage'


class User{
 
    responseAfterLogin(res){      
        const access_token = res.data.access_token;

        const username = res.data.name;

        if(Token.isValid(access_token))
        {
           AppStorage.store(access_token,username)
        }
    }

    hastoken()
    {
        const storeToken = localStorage.getItem('token');
        if(storeToken){
            return Token.isValid(storeToken) ?true :false
        }
        false
    }
    
    loggedIn(){
        return this.hastoken()
    }

    loginCheck(){
        return this.hastoken();
    }
    logout(){
        AppStorage.clear()
    }
    
    name()
    {
        if(this.loggedIn()){
            return localStorage.getItem('user')
        }
    }
    id(){
        if(this.loggedIn()){
            const payload = Token.payload(localStorage.getItem('token'))
           return payload.sub
        }
        return false
    }
    test(){
        return console.log('testing successfully updated');
    }


}


export default User = new User();