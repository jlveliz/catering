import axios from 'axios';





const login = async (email, password, remember = false) => {
    remember = remember ? true : false
    let promise = await axios.post('/api/login', {
        email,
        password,
        remember
    })
    return promise;
}

const setToken = (token) => {
    localStorage.setItem('token',token);
}

export { login, setToken };
