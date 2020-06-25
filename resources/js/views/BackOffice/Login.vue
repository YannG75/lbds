<template>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form>
                <div class="user-box">
                    <input type="text" v-model="email" required>
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="password" v-model="password" required>
                    <label>Password</label>
                </div>
                <div class="is-flex center">
                    <b-button type="is-light" @click="submit">Connexion</b-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import AdminNav from "../../components/AdminNav";
    import axios from 'axios'
    import {mapActions} from 'vuex'

    export default {
        name: "Login",
        components: {
            AdminNav
        },
        data() {
            return {
                email: "",
                password: "",
            }
        },
        methods: {
            ...mapActions({
                signIn: 'auth/signIn'
            }),

            async submit() {
                await this.signIn({email: this.email, password: this.password})

                await this.$router.replace('/admin')
            }
        }
    }
</script>

<style scoped lang="scss">
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 65vh;
    }

    .login-box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        padding: 40px;
        transform: translate(-50%, -50%);
        background: rgb(33, 33, 33);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgb(33, 33, 33);
        border-radius: 10px;
    }

    .login-box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }

    .login-box .user-box {
        position: relative;
    }

    .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
    }

    .login-box .user-box input:focus ~ label,
    .login-box .user-box input:valid ~ label {
        top: -20px;
        left: 0;
        color: #3ee28d;
        font-size: 12px;
    }

    input:-webkit-autofill, input:-webkit-autofill:focus, input:-webkit-autofill:active {
        -webkit-text-fill-color: aliceblue;
        -webkit-box-shadow: 0 0 0px 1000px rgb(33, 33, 33) inset;
    }

</style>
