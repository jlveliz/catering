import axios from 'axios';


export default class Auth {

    login(email,password,remember){
        
        const login = axios.post('/api/login',{
            email,
            password
        })
        console.log(login);
        return login
        
    }

}