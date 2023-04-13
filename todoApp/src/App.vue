<template>
  <ion-app>
    <ion-router-outlet />
  </ion-app>
</template>

<script>
import { IonApp, IonRouterOutlet, alertController } from '@ionic/vue';
import { Network } from '@capacitor/network';

export default({
  name: 'App',
  components: { IonApp, IonRouterOutlet },
  data() {
    return {
      removeAlert: false
    }
  },
  methods: {
    async noConnection() {
      const noConnectionalert = await alertController.create({
          header: 'Connection Alert!',
          message: 'You must have an internet connection in order to use this app.',
        });

        await noConnectionalert.present();
    },
    async hasConnection() {
      this.removeAlert = false;
      const hasConnectionalert = await alertController.create({
          header: 'Connection Restored!',
          message: 'You\'re internet connection is restored! Reloading...',
        });

        await hasConnectionalert.present();

        setTimeout(() => { window.location.reload(); }, 3000);
    }
  },
  mounted() {
    Network.addListener('networkStatusChange', status => {
      console.log('Network status changed', status);
      return !status.connected ? this.noConnection() : this.hasConnection();
    });
  }
});
</script>
