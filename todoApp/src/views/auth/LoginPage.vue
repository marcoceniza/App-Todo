<template>
  <ion-page>
    <ion-content :fullscreen="true">
        <ion-list>
            <ion-item>
                <ion-label position="stacked">Username</ion-label>
                <ion-input placeholder="Enter text"></ion-input>
            </ion-item>
            <ion-item>
                <ion-label position="stacked">Password</ion-label>
                <ion-input placeholder="Enter text"></ion-input>
            </ion-item>
            <ion-item>
                <ion-button>LOGIN</ion-button>
            </ion-item>
        </ion-list>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonContent, IonPage } from '@ionic/vue';
import axios from 'axios';

export default({
  name: 'LoginPage',
  components: { IonContent, IonPage },
  data() {
    return {
      email: '',
      password: ''
    }
  },

  methods: {
    submitForm() {
      axios.post('/api/auth/login', {
        email: this.email,
        password: this.password
      }).then(response => {
        // Store the user's information and token in localStorage
        localStorage.setItem('user', JSON.stringify(response.data.user));
        localStorage.setItem('token', response.data.token);

        // Redirect to the todo list page
        this.$router.push('/todos');
      }).catch(error => {
        console.log(error.response.data);
      });
    }
  }
});
</script>