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
          <h2 class="ion-text-center">Login</h2>
            <ion-item>
                <ion-input v-model="email" type="email" name="email" label="Email" labelPlacement="stacked" placeholder="Enter email"></ion-input>
            </ion-item>
            <ion-item>
                <ion-input v-model="password" type="password" name="password" label="Password" labelPlacement="stacked" placeholder="Enter password"></ion-input>
            </ion-item>
            <ion-button @click.prevent="submitForm" class="ion-padding" expand="block">
              <span v-if="!loaderIcon">SIGNIN</span>
              <span v-if="loaderIcon"><ion-spinner name="crescent"></ion-spinner></span>
            </ion-button>
        </ion-list>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonPage, IonList, IonInput, IonButton, IonItem, IonButtons, IonContent, IonHeader, IonToolbar, IonIcon, IonSpinner } from '@ionic/vue';
import { chevronBack } from 'ionicons/icons';
import { Toast } from '@capacitor/toast';
import axiosRes from '@/main';

export default({
  name: 'LoginPage',
  components: { IonPage, IonList, IonInput, IonButton, IonItem, IonButtons, IonContent, IonHeader, IonToolbar, IonIcon, IonSpinner },
  setup() { return { chevronBack } },
  data() {
    return {
      email: '',
      password: '',
      loaderIcon: false
    }
  },
  methods: {
    submitForm() {
      if(this.email == '' || this.password == '') {
          Toast.show({
              text: 'Username or Password is Empty!',
              duration: 5000,
              position: 'top',
          });

          return;
      }else {
        const formData = new FormData();
        formData.append('email', this.email);
        formData.append('password', this.password);

        this.loaderIcon = true;

        axiosRes.post('/login/', formData).then(res => {

          if(res.data.error) {
            Toast.show({
                text: res.data.error,
                duration: 5000,
                position: 'top',
            });
            this.loaderIcon = false;
            return;
          }

          localStorage.setItem('user', JSON.stringify(res.data.user));
          localStorage.setItem('token', res.data.token);

          this.$router.push('dashboard');

          setTimeout(() => {
            this.loaderIcon = false;
            this.email = '';
            this.password = '';
          }, 2000)

          Toast.show({
              text: 'Login Succesfully!',
              duration: 5000,
              position: 'top',
          });
        });
      }
    },
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