<template>
    <div>
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" v-model="formData.email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" v-model="formData.password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                formData: {
                    email: '',
                    password: '',
                },
            };
        },
        methods: {
            login() {
                // Perform login logic here
                // You can make an API request to your backend using Axios or any other HTTP library
                // Example:
                // axios.post('/login', this.formData)
                //   .then(response => {
                //     // Handle success
                //   })
                //   .catch(error => {
                //     // Handle error
                //   });
            },
        },
    };
</script>
