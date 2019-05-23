<template>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <form @submit.prevent="submit">
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input type="email" name="email" v-model="email" placeholder="email" class="input">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input type="password" name="password" v-model="password" placeholder="password" class="input">
                            </div>
                        </div>


                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
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
            /**
             * Submit login
             */
            submit() {
                this.axios.post(`/api/login`, {email: this.email, password: this.password})
                    .then((response) => {
                        localStorage.setItem('token', response.data.api_token);
                        this.$router.push('/');
                    })
            }
        }
    }
</script>

<style scoped lang="scss">

</style>