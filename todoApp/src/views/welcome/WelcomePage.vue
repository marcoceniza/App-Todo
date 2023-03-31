<template>
  <ion-page>
    <ion-content :fullscreen="true">
      <div id="container">
        <h2>Todo</h2>
        <ion-button @click="$router.push('/login')">Login</ion-button>
        <ion-button>Signup</ion-button>
      </div>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonContent, IonPage, IonButton } from '@ionic/vue';

export default({
    name: 'WelcomePage',
    components: { IonContent, IonPage, IonButton },
});
</script>


<style scoped>
#container {
  text-align: center;
  
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}

#container strong {
  font-size: 20px;
  line-height: 26px;
}

#container p {
  font-size: 16px;
  line-height: 22px;
  
  color: #8c8c8c;
  
  margin: 0;
}

#container a {
  text-decoration: none;
}
</style>