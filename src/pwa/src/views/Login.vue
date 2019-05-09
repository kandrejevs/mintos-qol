<template>
    <div class="login">
        <form @submit.prevent="submit" >
            <input type="email" name="email" v-model="email" placeholder="email">
            <input type="password" name="password" v-model="password" placeholder="password">
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data: function () {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            submit () {
                this.axios.post(`/api/login`, {email: this.email, password: this.password})
                    .then((response) => {
                        localStorage.setItem('token', response.data.api_token);
                        this.$router.push('/');
                    })
                    .catch(() => {
                    })
                    .then(() => {
                    });
            }
        }
    }
</script>

<style scoped>
    input,
    button {
        width: 100%;
        padding: 10px;
        margin: 0 0 15px 0;
    }
</style>