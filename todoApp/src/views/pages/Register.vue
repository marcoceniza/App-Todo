<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-button @click="$router.push('welcome')"><ion-icon :icon="chevronBack"></ion-icon></ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
        <ion-list>
          <h2 class="ion-text-center">Register</h2>
            <ion-item>
                <ion-input v-model="email" type="email" name="email" label="Email" labelPlacement="stacked" placeholder="Enter email" required></ion-input>
            </ion-item>
            <ion-item>
                <ion-input v-model="username" type="text" name="username" label="Username" labelPlacement="stacked" placeholder="Enter username" required></ion-input>
            </ion-item>
            <ion-item>
                <ion-input v-model="password" type="password" name="password" label="Password" labelPlacement="stacked" placeholder="Enter password" required></ion-input>
            </ion-item>
            <ion-button @click.prevent="registerForm" class="ion-padding" expand="block">
              <span v-if="!loaderIcon">SIGNUP</span>
              <span v-if="loaderIcon"><ion-spinner name="crescent"></ion-spinner></span>
            </ion-button>
        </ion-list>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonPage, IonList, IonInput, IonButton, IonItem, IonButtons, IonContent, IonHeader, IonToolbar, IonIcon, IonSpinner } from '@ionic/vue';
import axiosRes from '@/main';
import { chevronBack } from 'ionicons/icons';
import { Toast } from '@capacitor/toast';

export default({
  name: 'RegisterPage',
  components: { IonPage, IonList, IonInput, IonButton, IonItem, IonButtons, IonContent, IonHeader, IonToolbar, IonIcon, IonSpinner },
  setup() { return { chevronBack } },
  data() {
    return {
      email: '',
      username: '',
      password: '',
      loaderIcon: false
    }
  },

  methods: {
    registerForm() {
        if(this.email == '' || this.username == '' || this.password == '') {
            Toast.show({
                text: 'All Fields are Required!',
                duration: 5000,
                position: 'top',
            });

            return;
        }else {
          this.loaderIcon = true;

            const formData = new FormData();
            formData.append('email', this.email);
            formData.append('username', this.username);
            formData.append('password', this.password);

            axiosRes.post('/register/', formData).then(() => {

                this.$router.push('login');

                Toast.show({
                    text: 'Register Succesfully!',
                    duration: 5000,
                    position: 'top',
                });
            })
        }
    }
  }
});
</script>

<style scoped>
ion-back-button {
  display: block;
}

ion-list {
  position: absolute;
  left: 0;
  right: 0;
  top: 15%;
  transform: translateY(15%);
  padding: 15px 15px 40px;
} 
</style>